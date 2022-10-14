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

/**
 * Sections accordion.
 */
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

/**
 * Sections accordion.
 */
var sa_notifications = function ($) {
    $(document).on('click', '.sa-notification-header', hideShowNotification)
    $(document).on('click', '.sa-active-input', activateNotification)

    function hideShowNotification() {
        var $notification = $(this).closest('.sa-notification')

        if ($notification.hasClass('collapsed')) {
            _showNotification($notification)
        } else {
            _hideNotification($notification)
        }
    }

    function _showNotification($notification) {
        $notification.find('.sa-notification-footer').slideDown(150)
        $notification.find('.sa-notification-content').slideDown(450)
        $notification.removeClass('collapsed')
    }

    function _hideNotification($notification) {
        $notification.find('.sa-notification-footer').slideUp(150)
        $notification.find('.sa-notification-content').slideUp(450, function () {
            $notification.addClass('collapsed')
        })
    }

    function activateNotification() {
        if ($(this).is(':checked')) {
            $(this).closest('label').find('.sa-active-switch-text').text('Inactivate')
        } else {
            $(this).closest('label').find('.sa-active-switch-text').text('Activate')
        }
    }
}(jQuery);

var sa_base = function ($) {

    $(document).ready(init)
    $(document).on('click', '.sa-time-slot', handleTimeSlotSelection)
    // $(document).on('click', 'button[data-toggle="sa-dropdown"]', hideShowDropdown)
    $(document).on('click', hideShowDropdown)
    $(document).on('click', '.sa-list-filter-btn', hideShowFiltersSection)
    $(document).on('click', '.sa-setting-menu', showSettingSection)

    function init() {
        sa_tooltip.init()

        $('.sa-appointments-list-table-wrapper table .check-column').find('input[type="checkbox"]').addClass('sa-form-check-input')
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

    function hideShowDropdown(event) {
        $dropdown = $(event.target).closest('.sa-dropdown')
        $dropdownToggle = $(event.target).closest('.sa-dropdown-toggle')
        if ($dropdownToggle.length) {
            $('.sa-dropdown-menu').removeClass('show')

            $dropdown.find('.sa-dropdown-menu').toggleClass('show')
            return;
        }

        if ($dropdown.length) {
            return;
        }

        $('.sa-dropdown-menu').removeClass('show')
    }

    function hideShowFiltersSection() {
        $filterBtn = $(this);

        if ($filterBtn.hasClass('sa-btn-outline')) {
            $filterBtn.removeClass('sa-btn-outline')
            $('.sa-appointments-list-filter').slideDown()
        } else {
            $filterBtn.addClass('sa-btn-outline')
            $('.sa-appointments-list-filter').slideUp()
        }
    }

    function showSettingSection() {
        if($(this).hasClass('active'))
            return;

        $('.sa-setting-menu').removeClass('active')
        $('.sa-setting-section').removeClass('active')
        $(this).addClass('active')
        $($(this).data('target')).addClass('active')
    }
}(jQuery);