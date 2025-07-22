(function ($) {
	'use strict';

	$.bind('ready', function () {
		var item_check = [
			['hs_first_agency_header_sticky_entire_website', ['hs_first_agency_header_sticky_bg_color'], 'yes'],
		];

		item_check.forEach(function (item, index) {
			$(item[0], function (setting) {
				var linkSettingValueToControlActiveState;
				linkSettingValueToControlActiveState = function (control) {
					var visibility = function () {
						var check = item[2];
						var value = $.value(item[0])();
						var activate = false;
						if (typeof check !== 'undefined') {
							if (Array.isArray(check)) {
								if (check.indexOf(value) !== -1) {
									activate = true;
								} else {
									activate = false;
								}
							} else {
								if (check === value) {
									activate = true;
								} else {
									activate = false;
								}
							}
						} else {
							activate = value;
						}

						if (activate) {
							control.container.slideDown(180);
						} else {
							control.container.slideUp(180);
						}
					};
					// Set initial active state.
					visibility();
					// Update activate state whenever the setting is changed.
					setting.bind(visibility);
				};

				// Call linkSettingValueToControlActiveState on each dependent id if is array
				if (Array.isArray(item[1])) {
					item[1].forEach(function (setting, index) {
						$.control(setting, linkSettingValueToControlActiveState);
					});
				} else {
					$.control(item[1], linkSettingValueToControlActiveState);
				}
			});
		});

		// show control when edit button selected
		jQuery('.first-agency-custom-refresh-partial').on('click', function (event) {
			event.stopImmediatePropagation();
			event.preventDefault();
			var data = [jQuery(this).attr('data-control'), jQuery(this).attr('data-focus')];
			// identify type to show
			if (data[1] === 'panel') {
				$.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				$.section(data[0]).focus();
			} else {
				$.control(data[0]).focus();
			}
		});
		$.previewer.bind('preview-edit', function (data) {
			// identify type to show
			if (data[1] === 'panel') {
				$.panel(data[0]).focus();
			} else if (data[1] === 'section') {
				$.section(data[0]).focus();
			} else {
				$.control(data[0]).focus();
			}
		});

		jQuery.fn.shake = function (settings) {
			if (typeof settings.interval === 'undefined') {
				settings.interval = 100;
			}

			if (typeof settings.distance === 'undefined') {
				settings.distance = 10;
			}

			if (typeof settings.times === 'undefined') {
				settings.times = 4;
			}

			if (typeof settings.complete === 'undefined') {
				settings.complete = function () {};
			}

			jQuery(this).css('position', 'relative');

			for (var iter = 0; iter < (settings.times + 1); iter++) {
				jQuery(this).animate({ left: ((iter % 2 === 0 ? settings.distance : settings.distance * -1)) }, settings.interval);
			}

			jQuery(this).animate({ left: 0 }, settings.interval, settings.complete);
		};
		jQuery('.focus_shake').on('focus', function () {
			jQuery(this).parent().shake({
				interval: 100,
				distance: 5,
				times: 5
			});
		});
	});
}(wp.customize));
