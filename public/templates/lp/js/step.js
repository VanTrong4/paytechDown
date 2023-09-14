jQuery(function ($) {

  let percent = 0;
  $("#company_name").blur(function () {
    changeHan($(this));
  });

  changeHan = function (ele) {
    var val = ele.val();
    var han = val.replace(/[A-Za-z0-9-!"#$%&'()=<>,.?_\[\]{}@^~\\]/g, function (s) { return String.fromCharCode(s.charCodeAt(0) + 65248) });
    $(ele).val(han);
  }
  $.getJSON(pref_city_url, function (data) {
    for (var i = 1; i < 48; i++) {
      var code = ('00' + i).slice(-2);
      $('#prefect').append('<option value="' + code + '">' + data[i - 1][code].pref + '</option>')
    }
  });
  $('#prefect').on('change', function () {
    $('#city option:nth-child(n+2)').remove();
    var select_pref = ('00' + $('#prefect option:selected').val()).slice(-2);
    var key = Number(select_pref) - 1;
    $.getJSON(pref_city_url, function (data) {
      for (var i = 0; i < data[key][select_pref].city.length; i++) {
        $('#city').append('<option value="' + data[key][select_pref].city[i].id + '">' + data[key][select_pref].city[i].name + '</option>')
      }
    })
    const prefect_txt = $('#prefect option:selected').text()
    $("#prefect_txt").val(prefect_txt);
  });
  $('#city').on('change', function () {
    const city_txt = $('#city option:selected').text()
    $("#city_txt").val(city_txt);
  });

  /* 

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
  }); */


  $("#form_step").on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
  $("#form_step")
    .multiStepForm({
      validations: {
        groups: {
          province: "prefect city",
        },
        rules: {
          company_name: "required",
          prefect: "required",
          city: "required",
          billing: "required",
        },
        // Specify validation error messages
        messages: {
          company_name: "※企業名を入力してください",
          prefect: "※この項目を選択してください",
          city: "※この項目を選択してください",
          billing: "※ご請求金額を入力してください",
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          var placement = $(element).closest('.step_group').find('.help-block');
          if (placement) {
            $(placement).show().html($(error));
          } else {
            $(error).insertAfter($(element));
          }
        },
      },
      beforeNavigate: function (form, step) {
      },
      afterNavigate: function (form, step) {
        const callback = form.find('.current').data('callback');
        if (callback == 'inputMoney') {
          inputMoney();
        }
        if (callback == 'calcMoney') {
          calcMoney();
        }
      }
    })
    .navigateTo(0);

})

function inputMoney() {


  const company_name = $("[name='company_name']").val();
  $(".company_name_txt").text(company_name);

  const company_size_percent = parseInt($("[name='company_size']:checked").data('percent'));
  const number_of_transactions_percent = parseInt($("[name='number_of_transactions']:checked").data('percent'));
  const has_contract_percent = parseInt($("[name='has_contract']:checked").data('percent'));
  percent = company_size_percent + number_of_transactions_percent + has_contract_percent;
  if (company_size_percent == 1 && number_of_transactions_percent == 1 && has_contract_percent == 1)
    percent = 1;
  $("#percent_txt").text(`${percent}`)
  step_table_preview();

}

function calcMoney() {
  const billing = parseInt($("#billing_text").val());
  const fundraising_percent = 100 - percent;
  const fundraising_price = parseInt( billing * fundraising_percent / 100);
  $("#percent").val(percent)
  $("#fundraising_percent").val(fundraising_percent)
  $("#fundraising_price").val(fundraising_price)
  $("#approximate_fee").html(`<strong><b>${percent}</b>％～</strong>`)
  $("#fundraising_rate").html(`<strong><b>${fundraising_percent}</b>％～</strong>`)
  $("#price_percent").html(`<strong><b>${fundraising_price}</b>万円～</strong>`);
  step_table_calc_preview();
}

function step_table_preview() {

  const company_name = $("[name='company_name']").val();

  const prefect = $("[name='prefect_txt'").val();
  const city = $("[name='city_txt'").val();
  const company_size = $("[name='company_size']:checked").val();
  const receivable_capital = $("[name='receivable_capital']:checked").val();
  const business_history = $("[name='business_history']:checked").val();
  const number_of_transactions = $("[name='number_of_transactions']:checked").val();
  const has_contract = $("[name='has_contract']:checked").val();
  const quick_was_used = $("[name='quick_was_used']:checked").val();

  const prefect_city = `${prefect}${city}`;


  const step_table_preview = `<div class="step_text">売掛先の企業情報</div>
  <table class="step_table_preview">
    <tr>
      <th>売掛先企業</th>
      <td id="_step_text">${company_name}</td>
    </tr>
    <tr>
      <th>売掛先企業の本社所在地</th>
      <td id="_step_text">${prefect_city}</td>
    </tr>
    <tr>
      <th>売掛先の企業規模</th>
      <td>${company_size}</td>
    </tr>
    <tr>
      <th>売掛先の資本金</th>
      <td>${receivable_capital}</td>
    </tr>
    <tr>
      <th>売掛先の業歴</th>
      <td>${business_history}</td>
    </tr>
    <tr>
      <th>売掛先とのお取引回数</th>
      <td>${number_of_transactions}</td>
    </tr>
    <tr>
      <th>売掛先との契約書の有無</th>
      <td>${has_contract}</td>
    </tr>
    <tr>
      <th>PAYTECH-ペイテック-<br>のご利用回数</th>
      <td>${quick_was_used}</td>
    </tr>
  </table>`;
  $("#step_table_preview").html(step_table_preview)
}

function step_table_calc_preview() {

  const company_name = $("[name='company_name']").val();

  const prefect = $("[name='prefect_txt']").val();
  const city = $("[name='city_txt']").val();
  const company_size = $("[name='company_size']:checked").val();
  const receivable_capital = $("[name='receivable_capital']:checked").val();
  const business_history = $("[name='business_history']:checked").val();
  const number_of_transactions = $("[name='number_of_transactions']:checked").val();
  const has_contract = $("[name='has_contract']:checked").val();
  const quick_was_used = $("[name='quick_was_used']:checked").val();

  const prefect_city = `${prefect}${city}`;
  const billing = $("[name='billing']").val();
  


  const step_table_calc_preview = `<div class="step_text">売掛先の企業情報</div>
  <table class="step_table_preview">
    <tr>
      <th>売掛先企業</th>
      <td id="_step_text">${company_name}</td>
    </tr>
    <tr>
      <th>売掛先企業の本社所在地</th>
      <td id="_step_text">${prefect_city}</td>
    </tr>
    <tr>
      <th>売掛先の企業規模</th>
      <td>${company_size}</td>
    </tr>
    <tr>
      <th>売掛先の資本金</th>
      <td>${receivable_capital}</td>
    </tr>
    <tr>
      <th>売掛先の業歴</th>
      <td>${business_history}</td>
    </tr>
    <tr>
      <th>売掛先とのお取引回数</th>
      <td>${number_of_transactions}</td>
    </tr>
    <tr>
      <th>売掛先との契約書の有無</th>
      <td>${has_contract}</td>
    </tr>
    <tr>
      <th>PAYTECH-ペイテック-<br>のご利用回数</th>
      <td>${quick_was_used}</td>
    </tr>
    <tr>
      <th>売掛先へのご請求金額</th>
      <td>${billing}万円</td>
    </tr>
  </table>`;
  $("#step_table_calc_preview").html(step_table_calc_preview)
}