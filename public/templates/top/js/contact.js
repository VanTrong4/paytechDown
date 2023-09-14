jQuery(function ($) {

  const loadingHtml = $(`<div id="form-sending"><div class="sending-mask"></div> <div class="sending-content"><img src="./common/rolling.gif" alt="送信中">送信中</div></div>`);
  const stepConfirm = 1;
  /* kntxtext.target = [
    ['fullname', 'furigana', kntxtext.constant.letterType.kana, kntxtext.constant.insertType.auto],
  ]; */
  $('#zipcode1').jpostal({
    postcode: [
      '#zipcode1',
      '#zipcode2'
    ],
    address: {
      '#address': '%3%4%5'
    }
  });
  $('#company_zipcode1').jpostal({
    postcode: [
      '#company_zipcode1',
      '#company_zipcode2'
    ],
    address: {
      '#company_address': '%3%4%5'
    }
  });

  $("#select_company").blur(function () {
    changeHan($(this));
  });

  changeHan = function (ele) {
    var val = ele.val();
    var han = val.replace(/[A-Za-z0-9-!"#$%&'()=<>,.?_\[\]{}@^~\\]/g, function (s) { return String.fromCharCode(s.charCodeAt(0) + 65248) });
    $(ele).val(han);
  }
  const pref_city_url = '/common/pref_city.json';
  $.getJSON(pref_city_url, function (data) {
    for (var i = 1; i < 48; i++) {
      var code = ('00' + i).slice(-2);
      $('#select-pref').append('<option value="' + code + '">' + data[i - 1][code].pref + '</option>')
    }
  });
  $('#select-pref').on('change', function () {
    $('#select-city option:nth-child(n+2)').remove();
    var select_pref = ('00' + $('#select-pref option:selected').val()).slice(-2);
    var key = Number(select_pref) - 1;
    $.getJSON(pref_city_url, function (data) {
      for (var i = 0; i < data[key][select_pref].city.length; i++) {
        $('#select-city').append('<option value="' + data[key][select_pref].city[i].id + '">' + data[key][select_pref].city[i].name + '</option>')
      }
    })
  });

  $('[type="tel"], [inputmode="decimal"], [inputmode="numeric"],[type="tel"]').keydown(function (event) {
    var charCode = (event.which) ? event.which : event.keyCode
    if (event.shiftKey) return false;
    if (!event.ctrlKey && charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105))
      return false;
    return true;
  });

  $('[type="tel"], [inputmode="decimal"], [inputmode="numeric"]').change(function () {
    const oldValue = $(this).val()
    const newValue = oldValue.replace(/^\D+/g, '');
    $(this).val(newValue);
  });

  $('[type="tel"], [inputmode="decimal"], [inputmode="numeric"]').keyup(function () {
    const oldValue = $(this).val()
    const newValue = oldValue.replace(/^\D+/g, '');
    $(this).val(newValue);
  });

  $("#applyForm").on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
  $("#applyForm .submit").click(function () {
    $('body').append(loadingHtml);
  });
  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param * 1000000)
  }, 'File size must be less than {0} MB');
  $("#applyForm")
    .multiStepForm({
      validations: {
       /*  groups: {
          zipcode: "zipcode1 zipcode2",
          company_zipcode1: "company_zipcode1 company_zipcode2",
        }, */
        rules: {
          company: "required",
          fullname: "required",
          phonenumber: "required",
          email: {
            required: true,
            email: true
          },
          /* zipcode1: "required",
          zipcode2: "required", */
          address: "required",
          amount: "required",
          format: "required",

          company_office: "required",/* 
          company_zipcode1: "required",
          company_zipcode2: "required", */
          company_address: "required",

        /*   photo_selfie: {
            required: true,
            extension: "pdf|png|jpg|jpeg"
          }, */
          photo_id_1: {
            required: true,
            extension: "pdf|png|jpg|jpeg",
            filesize : 5, // here we are working with MB
          },
          photo_id_2: {
            required: true,
            extension: "pdf|png|jpg|jpeg",
            filesize : 5, // here we are working with MB
          },
          photo_bill: {
            required: true,
            extension: "pdf|png|jpg|jpeg",
            filesize : 5, // here we are working with MB
          },
          photo_item: {
            // required: true,
            extension: "pdf|png|jpg|jpeg",
            filesize : 5, // here we are working with MB
          },
        },
        // Specify validation error messages
        messages: {
          company: "※ご住所を入力してください",
          fullname: "※会社名・屋号名を入力してください",
          phonenumber: "※電話番号を入力してください",
          email: "※メールアドレスを半角英数で入力してください",/* 
          zipcode1: "※郵便番号を入力してください",
          zipcode2: "※郵便番号を入力してください", */
          address: "※お名前を入力してください",
          amount: "※買取希望金額を入力してください",
          format: "※ご希望のファクタリング形式を選択してください",
          company_office: "※売掛先の企業名を入力してください",/* 
          company_zipcode1: "※郵便番号を入力してください",
          company_zipcode2: "※郵便番号を入力してください", */
          company_address: "※売掛先の所在地を入力してください",
          /* 
          photo_selfie: {
            required: "※セルフィー（自画撮り）を入力してください",
            extension: "※PDF/JPEG/PNG　対応"
          }, */
          photo_id_1: {
            required: "※身分証明書（前面・裏面）を入力してください",
            extension: "※PDF/JPEG/PNG　対応",
            filesize: "※添付するファイルサイズは 5 MB 未満にする必要があります"
          },
          photo_id_2: {
            required: "※身分証明書（裏面）を入力してください",
            extension: "※PDF/JPEG/PNG　対応",
            filesize: "※添付するファイルサイズは 5 MB 未満にする必要があります"
          },
          photo_bill: {
            required: "※売掛先の請求書・注文書データを入力してください",
            extension: "※PDF/JPEG/PNG　対応",
            filesize: "※添付するファイルサイズは 5 MB 未満にする必要があります"
          },
          photo_item: {
            // required: "※成因証書データを入力してください",
            extension: "※PDF/JPEG/PNG　対応",
            filesize: "※添付するファイルサイズは 5 MB 未満にする必要があります"
          },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          var placement = $(element).closest('.form-group').find('.help-block');
          if (placement) {
            $(placement).show().html($(error));
          } else {
            error.insertAfter(element);
          }
        },
      },
      beforeNavigate: function (form, step) {
      },
      afterNavigate: function (form, step) {

        if (step == stepConfirm) {
          if ($("[name='_confirm']").length == 0)
            form.prepend($(`<input type='hidden' value='form-has-confirm' name='_confirm'>`))

          $("#contact-title").html(`<span class="bg-wrap"><span class="inn"><span>送信確認画面</span></span></span>`)
          $('body').append(loadingHtml);
          const company = $("[name='company']").val();
          const fullname = $("[name='fullname']").val();
          const phonenumber = $("[name='phonenumber']").val();
          const email = $("[name='email']").val();/* 
          const zipcode1 = $("[name='zipcode1']").val();
          const zipcode2 = $("[name='zipcode2']").val(); */
          const address = $("[name='address']").val();
          const amount = $("[name='amount']").val();
          const format = $("[name='format']:checked").val();
          const company_office = $("[name='company_office']").val();/* 
          const company_zipcode1 = $("[name='company_zipcode1']").val();
          const company_zipcode2 = $("[name='company_zipcode2']").val(); */
          const company_address = $("[name='company_address']").val();
          const company_other = $("[name='company_other']").val();
          const company_phone_my = $("[name='company_phone_my']").val();


          $("#company_confirm").text(company);
          $("#fullname_confirm").text(fullname);
          $("#phonenumber_confirm").text(phonenumber);
          $("#email_confirm").text(email);
          /*  $("#zipcode_confirm").text(`〒${zipcode1}-${zipcode2}`); */
          $("#address_confirm").text(address);
          $("#amount_confirm").text(amount);
          $("#format_confirm").text(format);
          $("#company_office_confirm").text(company_office);/* 
          $("#company_zipcode_confirm").text(`〒${company_zipcode1}-${company_zipcode2}`); */
          $("#company_address_confirm").text(company_address);
          $("#company_other_confirm").text(company_other);
          $("#company_phone_my_confirm").text(company_phone_my);
          /* 
          $("#photo_selfie_confirm").text(photo_selfie);
          $("#photo_id_1_confirm").text(photo_id_1);
          $("#photo_id_2_confirm").text(photo_id_2);
          $("#photo_bill_confirm").text(photo_bill); 
            $("#photo_item_confirm").text(photo_item); 
          */
          $("html, body").animate({ scrollTop: 0 }, 400);
          setTimeout(function () { loadingHtml.remove(); }, 400);
        } else {
          $("#contact-title").html(`<span class="bg-wrap"><span class="inn"><span>お申し込み</span>フォーム</span></span>`)
        }

      }
    })
    .navigateTo(0);

  $(".file_input").on("change", function (e) {
    const field_name = $(this).attr('name');
    const confirm_tag = $(`#${field_name}_confirm, #${field_name}_preview`);
    if (e.target.files.length == 0) {
      confirm_tag.html('');
    }
    var file = e.target.files[0];

    const name = file.name;
    const lastDot = name.lastIndexOf('.');
    let ext = name.substring(lastDot + 1).toLowerCase();
    switch (ext) {
      case "png":
      case "jpg":
      case "jpeg":
        const src = URL.createObjectURL(file);
        confirm_tag.html(`<div class="preview"><div class="preview_img"><img src="${src}"></div><span>${name}</span></div>`)
        break;
      case "pdf":
        confirm_tag.html(`<div class="preview"><div class="preview_pdf"><img src="../assets/images/icon-pdf.svg"></div><span>${name}</span></div>`)
        break;
      default:
        confirm_tag.html('');
        break;
    }
  });

})