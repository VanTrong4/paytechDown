(function ($) {
  $.fn.multiStepForm = function (args) {
    if (args === null || typeof args !== 'object' || $.isArray(args))
      throw " : Called with Invalid argument";
    var form = this;
    var tabs = form.find('.tab');
    var steps = form.find('.step');
    steps.each(function (i, e) {
      $(e).on('click', function (ev) {
      });
    });
    form.navigateTo = function (i) {/*index*/

      if (typeof args.beforeNavigate !== 'undefined' && typeof args.beforeNavigate === 'function') {
        args.beforeNavigate(form, i);
      }

      /*Mark the current section with the class 'current'*/
      tabs.removeClass('current').eq(i).addClass('current');
      tabs.eq(i).find('input[type="radio"]:checked').prop("checked", false);
      // Show only the navigation buttons that make sense for the current section:
      form.find('.previous').toggle(i > 0);
      atTheEnd = i >= tabs.length - 1;
      form.find('.next').toggle(!atTheEnd);
      form.find('.submit').toggle(atTheEnd).toggleClass('show', atTheEnd);

      atInput = i >= tabs.length - 2;
      form.find('#common_form_action').toggle(!atInput);


      fixStepIndicator(curIndex());

      if (typeof args.afterNavigate !== 'undefined' && typeof args.afterNavigate === 'function') {
        args.afterNavigate(form, i);
      }
      return form;
    }
    function curIndex() {
      /*Return the current index by looking at which section has the class 'current'*/
      return tabs.index(tabs.filter('.current'));
    }
    function fixStepIndicator(n) {
      steps.each(function (i, e) {
        i == n ? $(e).addClass('active') : $(e).removeClass('active');
      });
    }
    /* Previous button is easy, just go back */
    form.find('.previous').click(function () {
      form.navigateTo(curIndex() - 1);
    });

    /* Next button goes forward iff current block validates */
    form.find('.next').click(function () {
      if ('validations' in args && typeof args.validations === 'object' && !$.isArray(args.validations)) {
        if (!('noValidate' in args) || (typeof args.noValidate === 'boolean' && !args.noValidate)) {
          form.validate(args.validations);
          if (form.valid() == true) {
            form.navigateTo(curIndex() + 1);
            return true;
          }else{            
            $("input.error").first().focus();
          }
          return false;
        }
      }
      form.navigateTo(curIndex() + 1);
    });

    /* Radio change*/
    form.find('.radio_wrap input[type="radio"]').change(function () {
      form.navigateTo(curIndex() + 1);
    });
    form.find('.submit').on('click', function (e) {
      if (typeof args.beforeSubmit !== 'undefined' && typeof args.beforeSubmit !== 'function')
        args.beforeSubmit(form, this);
      /*check if args.submit is set false if not then form.submit is not gonna run, if not set then will run by default*/
      if (typeof args.submit === 'undefined' || (typeof args.submit === 'boolean' && args.submit)) {
        form.submit();
      }
      return form;
    });
    /*By default navigate to the tab 0, if it is being set using defaultStep property*/
    typeof args.defaultStep === 'number' ? form.navigateTo(args.defaultStep) : null;

    form.noValidate = function () {

    }
    return form;
  };
}(jQuery));