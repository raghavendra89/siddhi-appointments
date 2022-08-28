var sa_tooltip = function ($) {
    function init() {
        $('*[data-sa-toggle="tooltip"]').hover(function (e) {
            $this = $(this)
            var tooltipText = $this.data('sa-title')
            $tooltip = $('<div class="sa-tooltip">'+ tooltipText +'</div>').appendTo('body')
            $tooltip.css('top', $this.offset().top - 42)
                    .css('left', $this.offset().left - ($tooltip.width() / 2))
                    .fadeIn()
        }, function () {
            $('.sa-tooltip').remove()
        })
    }

    return {
        init: init
    }
}(jQuery);

var sa_sections = function ($) {
    $(document).on('click', '.sa-section-header', hideShowSection)

    function hideShowSection() {
        var $section = $(this).closest('.sa-section')

        if ($section.hasClass('collapsed')) {
            _showSection($section)
        } else {
            _hideSection($section)
        }
    }

    function _showSection($section) {
        $section.find('.sa-section-body').slideDown(450)
        $section.removeClass('collapsed')
    }

    function _hideSection($section) {
        $section.find('.sa-section-body').slideUp(450, function () {
            $section.addClass('collapsed')
        })
    }
}(jQuery);

var sa_base = function ($) {

    $(document).ready(init)
    $(document).on('click', '.sa-time-slot', handleTimeSlotSelection)

    function init() {
        sa_tooltip.init()
    }

    function handleTimeSlotSelection() {
        $slot = $(this)
        if ($slot.hasClass('checked')) {
            $slot.find('input').prop('checked', false)
        } else {
            $slot.find('input').prop('checked', true)
        }

        $slot.toggleClass('checked')
    }
}(jQuery);