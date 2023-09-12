jQuery(function ($) {
  $('[inputmode="tel"], [inputmode="decimal"], [inputmode="numeric"],[type="tel"]').keydown(function (event) {
    var charCode = (event.which) ? event.which : event.keyCode
    if (event.shiftKey) return false;
    if (!event.ctrlKey && charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105))
      return false;
    return true;
  });

  $('[inputmode="tel"], [inputmode="decimal"], [inputmode="numeric"]').change(function () {
    const oldValue = $(this).val()
    const newValue = oldValue.replace(/^\D+/g, '');
    $(this).val(newValue);
  });

  $('[inputmode="tel"], [inputmode="decimal"], [inputmode="numeric"]').keyup(function () {
    const oldValue = $(this).val()
    const newValue = oldValue.replace(/^\D+/g, '');
    $(this).val(newValue);
  });
  $('form').on('keyup keypress', function (e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
  $(".view-pass").click(function () {
    const pass = $(this).next();
    if (pass.attr("type") == "password") {
      $(this).html(`<img width="25" src="/templates/frontend/imgs/password-hide.svg" alt="hide">`);
      pass.attr("type", "text");
    } else {
      $(this).html(`<img width="25" src="/templates/frontend/imgs/password-show.png" alt="show">`);
      $(this).next().attr("type", "password");
    }
  });

  $("input[type='file']").on("change", function (e) {
    const field_name = $(this).attr('name');
    const preview = $(`#${field_name}_preview, #confirm_${field_name}`);
    if (e.target.files.length == 0) {
      preview.html('');
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
        preview.html(`<img src="${src}">`)
        break;
      default:
        preview.html('');
        break;
    }
  });
  $('form').on('submit', function () {
    $('body').append(`<div id="sending">
    <div class="lds-roller">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>`);
  })
})