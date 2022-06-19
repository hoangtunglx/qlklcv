"use strict";

function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }
function _objectWithoutProperties(source, excluded) { if (source == null) return {}; var target = _objectWithoutPropertiesLoose(source, excluded); var key, i; if (Object.getOwnPropertySymbols) { var sourceSymbolKeys = Object.getOwnPropertySymbols(source); for (i = 0; i < sourceSymbolKeys.length; i++) { key = sourceSymbolKeys[i]; if (excluded.indexOf(key) >= 0) continue; if (!Object.prototype.propertyIsEnumerable.call(source, key)) continue; target[key] = source[key]; } } return target; }
function _objectWithoutPropertiesLoose(source, excluded) { if (source == null) return {}; var target = {}; var sourceKeys = Object.keys(source); var key, i; for (i = 0; i < sourceKeys.length; i++) { key = sourceKeys[i]; if (excluded.indexOf(key) >= 0) continue; target[key] = source[key]; } return target; }
function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) { symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); } keys.push.apply(keys, symbols); } return keys; }
function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }
function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

/* -------------------------------------------------------------------------- */
/*                                    Utils                                   */
/* -------------------------------------------------------------------------- */
var docReady = function docReady(fn) {
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', fn);
	} else {
		setTimeout(fn, 1);
	}
};

var resize = function resize(fn) {
	return window.addEventListener('resize', fn);
};

var isIterableArray = function isIterableArray(array) {
	return Array.isArray(array) && !!array.length;
};

var camelize = function camelize(str) {
	var text = str.replace(/[-_\s.]+(.)?/g, function (_, c) {
		return c ? c.toUpperCase() : '';
	});
	return "".concat(text.substr(0, 1).toLowerCase()).concat(text.substr(1));
};

var getData = function getData(el, data) {
	try {
		return JSON.parse(el.dataset[camelize(data)]);
	} catch (e) {
		return el.dataset[camelize(data)];
	}
};

var hexToRgb = function hexToRgb(hexValue) {
	var hex;
	hexValue.indexOf('#') === 0 ? hex = hexValue.substring(1) : hex = hexValue;
	var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
	var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex.replace(shorthandRegex, function (m, r, g, b) {
		return r + r + g + g + b + b;
	}));
	return result ? [parseInt(result[1], 16), parseInt(result[2], 16), parseInt(result[3], 16)] : null;
};

var rgbaColor = function rgbaColor() {
	var color = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '#fff';
	var alpha = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0.5;
	return "rgba(".concat(hexToRgb(color), ", ").concat(alpha, ")");
};

var getColor = function getColor(name) {
	var dom = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document.documentElement;
	return getComputedStyle(dom).getPropertyValue("--falcon-".concat(name)).trim();
};

var getColors = function getColors(dom) {
	return {
		primary: getColor('primary', dom),
		secondary: getColor('secondary', dom),
		success: getColor('success', dom),
		info: getColor('info', dom),
		warning: getColor('warning', dom),
		danger: getColor('danger', dom),
		light: getColor('light', dom),
		dark: getColor('dark', dom)
	};
};

var getSoftColors = function getSoftColors(dom) {
	return {
		primary: getColor('soft-primary', dom),
		secondary: getColor('soft-secondary', dom),
		success: getColor('soft-success', dom),
		info: getColor('soft-info', dom),
		warning: getColor('soft-warning', dom),
		danger: getColor('soft-danger', dom),
		light: getColor('soft-light', dom),
		dark: getColor('soft-dark', dom)
	};
};

var getGrays = function getGrays(dom) {
	return {
		white: getColor('white', dom),
		100: getColor('100', dom),
		200: getColor('200', dom),
		300: getColor('300', dom),
		400: getColor('400', dom),
		500: getColor('500', dom),
		600: getColor('600', dom),
		700: getColor('700', dom),
		800: getColor('800', dom),
		900: getColor('900', dom),
		1000: getColor('1000', dom),
		1100: getColor('1100', dom),
		black: getColor('black', dom)
	};
};

var hasClass = function hasClass(el, className) {
	!el && false;
	return el.classList.value.includes(className);
};

var addClass = function addClass(el, className) {
	el.classList.add(className);
};

var getOffset = function getOffset(el) {
	var rect = el.getBoundingClientRect();
	var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
	var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
	return {
		top: rect.top + scrollTop,
		left: rect.left + scrollLeft
	};
};

function isScrolledIntoView(el) {
	var rect = el.getBoundingClientRect();
	var windowHeight = window.innerHeight || document.documentElement.clientHeight;
	var windowWidth = window.innerWidth || document.documentElement.clientWidth;
	var vertInView = rect.top <= windowHeight && rect.top + rect.height >= 0;
	var horInView = rect.left <= windowWidth && rect.left + rect.width >= 0;
	return vertInView && horInView;
}

var breakpoints = {
	xs: 0,
	sm: 576,
	md: 768,
	lg: 992,
	xl: 1200,
	xxl: 1540
};

var getBreakpoint = function getBreakpoint(el) {
	var classes = el && el.classList.value;
	var breakpoint;
	if (classes) {
		breakpoint = breakpoints[classes.split(' ').filter(function (cls) {
			return cls.includes('navbar-expand-');
		}).pop().split('-').pop()];
	}
	return breakpoint;
};

var setCookie = function setCookie(name, value, expire) {
	var expires = new Date();
	expires.setTime(expires.getTime() + expire);
	document.cookie = "".concat(name, "=").concat(value, ";expires=").concat(expires.toUTCString());
};

var getCookie = function getCookie(name) {
	var keyValue = document.cookie.match("(^|;) ?".concat(name, "=([^;]*)(;|$)"));
	return keyValue ? keyValue[2] : keyValue;
};

var settings = {
	tinymce: {
		theme: 'oxide'
	},
	chart: {
		borderColor: 'rgba(255, 255, 255, 0.8)'
	}
};

var newChart = function newChart(chart, config) {
	var ctx = chart.getContext('2d');
	return new window.Chart(ctx, config);
};

var getItemFromStore = function getItemFromStore(key, defaultValue) {
	var store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;
	try {
		return JSON.parse(store.getItem(key)) || defaultValue;
	} catch (_unused) {
		return store.getItem(key) || defaultValue;
	}
};

var setItemToStore = function setItemToStore(key, payload) {
	var store = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : localStorage;
	return store.setItem(key, payload);
};

var getStoreSpace = function getStoreSpace() {
	var store = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : localStorage;
	return parseFloat((escape(encodeURIComponent(JSON.stringify(store))).length / (1024 * 1024)).toFixed(2));
};

var getDates = function getDates(startDate, endDate) {
	var interval = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 1000 * 60 * 60 * 24;
	var duration = endDate - startDate;
	var steps = duration / interval;
	return Array.from({
		length: steps + 1
	}, function (v, i) {
		return new Date(startDate.valueOf() + interval * i);
	});
};

var getPastDates = function getPastDates(duration) {
	var days;
	switch (duration) {
		case 'week':
			days = 7;
			break;
		case 'month':
			days = 30;
			break;
		case 'year':
			days = 365;
			break;
		default:
			days = duration;
	}
	var date = new Date();
	var endDate = date;
	var startDate = new Date(new Date().setDate(date.getDate() - (days - 1)));
	return getDates(startDate, endDate);
};

var getRandomNumber = function getRandomNumber(min, max) {
	return Math.floor(Math.random() * (max - min) + min);
};

var utils = {
	docReady: docReady,
	resize: resize,
	isIterableArray: isIterableArray,
	camelize: camelize,
	getData: getData,
	hasClass: hasClass,
	addClass: addClass,
	hexToRgb: hexToRgb,
	rgbaColor: rgbaColor,
	getColor: getColor,
	getColors: getColors,
	getSoftColors: getSoftColors,
	getGrays: getGrays,
	getOffset: getOffset,
	isScrolledIntoView: isScrolledIntoView,
	getBreakpoint: getBreakpoint,
	setCookie: setCookie,
	getCookie: getCookie,
	newChart: newChart,
	settings: settings,
	getItemFromStore: getItemFromStore,
	setItemToStore: setItemToStore,
	getStoreSpace: getStoreSpace,
	getDates: getDates,
	getPastDates: getPastDates,
	getRandomNumber: getRandomNumber
};

/* -------------------------------------------------------------------------- */
/*                                  Detector                                  */
/* -------------------------------------------------------------------------- */
var detectorInit = function detectorInit() {
	var _window = window,
		is = _window.is;
	var html = document.querySelector('html');
	is.opera() && addClass(html, 'opera');
	is.mobile() && addClass(html, 'mobile');
	is.firefox() && addClass(html, 'firefox');
	is.safari() && addClass(html, 'safari');
	is.ios() && addClass(html, 'ios');
	is.iphone() && addClass(html, 'iphone');
	is.ipad() && addClass(html, 'ipad');
	is.ie() && addClass(html, 'ie');
	is.edge() && addClass(html, 'edge');
	is.chrome() && addClass(html, 'chrome');
	is.mac() && addClass(html, 'osx');
	is.windows() && addClass(html, 'windows');
	navigator.userAgent.match('CriOS') && addClass(html, 'chrome');
};

var DomNode = function () {
	function DomNode(node) {
		_classCallCheck(this, DomNode);
		this.node = node;
	}
	_createClass(DomNode, [{
		key: "addClass",
		value: function addClass(className) {
			this.isValidNode() && this.node.classList.add(className);
		}
	}, {
		key: "removeClass",
		value: function removeClass(className) {
			this.isValidNode() && this.node.classList.remove(className);
		}
	}, {
		key: "toggleClass",
		value: function toggleClass(className) {
			this.isValidNode() && this.node.classList.toggle(className);
		}
	}, {
		key: "hasClass",
		value: function hasClass(className) {
			this.isValidNode() && this.node.classList.contains(className);
		}
	}, {
		key: "data",
		value: function data(key) {
			if (this.isValidNode()) {
				try {
					return JSON.parse(this.node.dataset[this.camelize(key)]);
				} catch (e) {
					return this.node.dataset[this.camelize(key)];
				}
			}
			return null;
		}
	}, {
		key: "attr",
		value: function attr(name) {
			return this.isValidNode() && this.node[name];
		}
	}, {
		key: "setAttribute",
		value: function setAttribute(name, value) {
			this.isValidNode() && this.node.setAttribute(name, value);
		}
	}, {
		key: "removeAttribute",
		value: function removeAttribute(name) {
			this.isValidNode() && this.node.removeAttribute(name);
		}
	}, {
		key: "setProp",
		value: function setProp(name, value) {
			this.isValidNode() && (this.node[name] = value);
		}
	}, {
		key: "on",
		value: function on(event, cb) {
			this.isValidNode() && this.node.addEventListener(event, cb);
		}
	}, {
		key: "isValidNode",
		value: function isValidNode() {
			return !!this.node;
		}
	}, {
		key: "camelize",
		value: function camelize(str) {
			var text = str.replace(/[-_\s.]+(.)?/g, function (_, c) {
				return c ? c.toUpperCase() : '';
			});
			return "".concat(text.substr(0, 1).toLowerCase()).concat(text.substr(1));
		}
	}]);
	return DomNode;
}();

/* -------------------------------------------------------------------------- */
/*                                  Anchor JS                                 */
/* -------------------------------------------------------------------------- */
var anchors = new window.AnchorJS();
anchors.options = {
	icon: '#'
};
anchors.add('[data-anchor]');

/* -------------------------------------------------------------------------- */
/*                                   Choices                                  */
/* -------------------------------------------------------------------------- */
var choicesInit = function choicesInit() {
	if (window.Choices) {
		var elements = document.querySelectorAll('.js-choice');
		elements.forEach(function (item) {
			var userOptions = utils.getData(item, 'options');
			var choices = new window.Choices(item, _objectSpread({
				itemSelectText: ''
			}, userOptions));
			return choices;
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                                  Copy link                                 */
/* -------------------------------------------------------------------------- */
var copyLink = function copyLink() {
	var copyLinkModal = document.getElementById('copyLinkModal');
	copyLinkModal && copyLinkModal.addEventListener('shown.bs.modal', function () {
		var invitationLink = document.querySelector('.invitation-link');
		invitationLink.select();
	});
	var copyButtons = document.querySelectorAll('[data-copy]');
	copyButtons && copyButtons.forEach(function (button) {
		var tooltip = new window.bootstrap.Tooltip(button);
		button.addEventListener('mouseover', function () {
			return tooltip.show();
		});
		button.addEventListener('mouseleave', function () {
			return tooltip.hide();
		});
		button.addEventListener('click', function (e) {
			e.stopPropagation();
			var el = e.target;
			el.setAttribute('data-original-title', 'Copied');
			tooltip.show();
			el.setAttribute('data-original-title', 'Copy to clipboard');
			tooltip.update();
			var inputID = utils.getData(el, 'copy');
			var input = document.querySelector(inputID);
			input.select();
			document.execCommand('copy');
		});
	});
};

/* -------------------------------------------------------------------------- */
/*                                  Count up                                  */
/* -------------------------------------------------------------------------- */
var countupInit = function countupInit() {
	if (window.countUp) {
		var countups = document.querySelectorAll('[data-countup]');
		countups.forEach(function (node) {
			var _utils$getData = utils.getData(node, 'countup'),
				endValue = _utils$getData.endValue,
				options = _objectWithoutProperties(_utils$getData, ["endValue"]);
			var countUp = new window.countUp.CountUp(node, endValue, _objectSpread({
				duration: 5
			}, options));
			if (!countUp.error) {
				countUp.start();
			} else {
				console.error(countUp.error);
			}
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                                Dropdown menu                               */
/* -------------------------------------------------------------------------- */
var dropdownMenuInit = function dropdownMenuInit() {
	if (window.is.ios()) {
		var Event = {
			SHOWN_BS_DROPDOWN: 'shown.bs.dropdown',
			HIDDEN_BS_DROPDOWN: 'hidden.bs.dropdown'
		};
		var Selector = {
			TABLE_RESPONSIVE: '.table-responsive',
			DROPDOWN_MENU: '.dropdown-menu'
		};
		document.querySelectorAll(Selector.TABLE_RESPONSIVE).forEach(function (table) {
			table.addEventListener(Event.SHOWN_BS_DROPDOWN, function (e) {
				var t = e.currentTarget;
				if (t.scrollWidth > t.clientWidth) {
					t.style.paddingBottom = "".concat(e.target.nextElementSibling.clientHeight, "px");
				}
			});
			table.addEventListener(Event.HIDDEN_BS_DROPDOWN, function (e) {
				e.currentTarget.style.paddingBottom = '';
			});
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                           Open dropdown on hover                           */
/* -------------------------------------------------------------------------- */
var dropdownOnHover = function dropdownOnHover() {
	var navbarArea = document.querySelector('[data-top-nav-dropdowns]');
	if (navbarArea) {
		navbarArea.addEventListener('mouseover', function (e) {
			if (e.target.className.includes('dropdown-toggle') && window.innerWidth > 992) {
				var dropdownInstance = new window.bootstrap.Dropdown(e.target);
				dropdownInstance._element.classList.add('show');
				dropdownInstance._menu.classList.add('show');
				dropdownInstance._menu.setAttribute('data-bs-popper', 'none');
				e.target.parentNode.addEventListener('mouseleave', function () {
					dropdownInstance.hide();
				});
			}
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                               From validation                              */
/* -------------------------------------------------------------------------- */
var formValidationInit = function formValidationInit() {
	var forms = document.querySelectorAll('.needs-validation');
	Array.prototype.slice.call(forms).forEach(function (form) {
		form.addEventListener('submit', function (event) {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
	});
};

/* -------------------------------------------------------------------------- */
/*                                  Glightbox                                 */
/* -------------------------------------------------------------------------- */
var glightboxInit = function glightboxInit() {
	if (window.GLightbox) {
		window.GLightbox({
			selector: '[data-gallery]'
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                           Icon copy to clipboard                           */
/* -------------------------------------------------------------------------- */
var iconCopiedInit = function iconCopiedInit() {
	var iconList = document.getElementById('icon-list');
	var iconCopiedToast = document.getElementById('icon-copied-toast');
	var iconCopiedToastInstance = new window.bootstrap.Toast(iconCopiedToast);
	if (iconList) {
		iconList.addEventListener('click', function (e) {
			var el = e.target;
			if (el.tagName === 'INPUT') {
				el.select();
				el.setSelectionRange(0, 99999);
				document.execCommand('copy');
				iconCopiedToast.querySelector('.toast-body').innerHTML = "<span class=\"fw-black\">Copied:</span> <code>".concat(el.value, "</code>");
				iconCopiedToastInstance.show();
			}
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                             Navbar combo layout                            */
/* -------------------------------------------------------------------------- */
var navbarComboInit = function navbarComboInit() {
	var Selector = {
		NAVBAR_VERTICAL: '.navbar-vertical',
		NAVBAR_TOP_COMBO: '[data-navbar-top="combo"]',
		COLLAPSE: '.collapse',
		DATA_MOVE_CONTAINER: '[data-move-container]',
		NAVBAR_NAV: '.navbar-nav',
		NAVBAR_VERTICAL_DIVIDER: '.navbar-vertical-divider'
	};
	var ClassName = {
		FLEX_COLUMN: 'flex-column'
	};
	var navbarVertical = document.querySelector(Selector.NAVBAR_VERTICAL);
	var navbarTopCombo = document.querySelector(Selector.NAVBAR_TOP_COMBO);
	var moveNavContent = function moveNavContent(windowWidth) {
		var navbarVerticalBreakpoint = utils.getBreakpoint(navbarVertical);
		var navbarTopBreakpoint = utils.getBreakpoint(navbarTopCombo);
		if (windowWidth < navbarTopBreakpoint) {
			var navbarCollapse = navbarTopCombo.querySelector(Selector.COLLAPSE);
			var navbarTopContent = navbarCollapse.innerHTML;
			if (navbarTopContent) {
				var targetID = utils.getData(navbarTopCombo, 'move-target');
				var targetElement = document.querySelector(targetID);
				navbarCollapse.innerHTML = '';
				targetElement.insertAdjacentHTML('afterend', "\n            <div data-move-container>\n              <div class='navbar-vertical-divider'>\n                <hr class='navbar-vertical-hr' />\n              </div>\n              ".concat(navbarTopContent, "\n            </div>\n          "));
				if (navbarVerticalBreakpoint < navbarTopBreakpoint) {
					var navbarNav = document.querySelector(Selector.DATA_MOVE_CONTAINER).querySelector(Selector.NAVBAR_NAV);
					utils.addClass(navbarNav, ClassName.FLEX_COLUMN);
				}
			}
		} else {
			var moveableContainer = document.querySelector(Selector.DATA_MOVE_CONTAINER);
			if (moveableContainer) {
				var _navbarNav = moveableContainer.querySelector(Selector.NAVBAR_NAV);
				utils.hasClass(_navbarNav, ClassName.FLEX_COLUMN) && _navbarNav.classList.remove(ClassName.FLEX_COLUMN);
				moveableContainer.querySelector(Selector.NAVBAR_VERTICAL_DIVIDER).remove();
				navbarTopCombo.querySelector(Selector.COLLAPSE).innerHTML = moveableContainer.innerHTML;
				moveableContainer.remove();
			}
		}
	};
	moveNavContent(window.innerWidth);
	utils.resize(function () {
		return moveNavContent(window.innerWidth);
	});
};

/* -------------------------------------------------------------------------- */
/*                           Navbar darken on scroll                          */
/* -------------------------------------------------------------------------- */
var navbarDarkenOnScroll = function navbarDarkenOnScroll() {
	var Selector = {
		NAVBAR: '[data-navbar-darken-on-scroll]',
		NAVBAR_COLLAPSE: '.navbar-collapse',
		NAVBAR_TOGGLER: '.navbar-toggler'
	};
	var ClassNames = {
		COLLAPSED: 'collapsed'
	};
	var Events = {
		SCROLL: 'scroll',
		SHOW_BS_COLLAPSE: 'show.bs.collapse',
		HIDE_BS_COLLAPSE: 'hide.bs.collapse',
		HIDDEN_BS_COLLAPSE: 'hidden.bs.collapse'
	};
	var DataKey = {
		NAVBAR_DARKEN_ON_SCROLL: 'navbar-darken-on-scroll'
	};
	var navbar = document.querySelector(Selector.NAVBAR);
	function removeNavbarBgClass() {
		navbar.classList.remove('bg-dark');
		navbar.classList.remove('bg-100');
	}
	var toggleThemeClass = function toggleThemeClass(theme) {
		if (theme === 'dark') {
			navbar.classList.remove('navbar-dark');
			navbar.classList.add('navbar-light');
		} else {
			navbar.classList.remove('navbar-light');
			navbar.classList.add('navbar-dark');
		}
	};
	function getBgClassName(name, defaultColorName) {
		var parent = document.documentElement;
		var allColors = _objectSpread(_objectSpread({}, utils.getColors(parent)), utils.getGrays(parent));
		var colorName = Object.keys(allColors).includes(name) ? name : defaultColorName;
		var color = allColors[colorName];
		var bgClassName = "bg-".concat(colorName);
		return {
			color: color,
			bgClassName: bgClassName
		};
	}
	if (navbar) {
		var theme = localStorage.getItem('theme');
		var defaultColorName = theme === 'dark' ? '100' : 'dark';
		var name = utils.getData(navbar, DataKey.NAVBAR_DARKEN_ON_SCROLL);
		toggleThemeClass(theme);
		var themeController = document.body;
		themeController.addEventListener('clickControl', function (_ref10) {
			var _ref10$detail = _ref10.detail,
				control = _ref10$detail.control,
				value = _ref10$detail.value;
			if (control === 'theme') {
				toggleThemeClass(value);
				defaultColorName = value === 'dark' ? '100' : 'dark';
				if (navbar.classList.contains('bg-dark') || navbar.classList.contains('bg-100')) {
					removeNavbarBgClass();
					navbar.classList.add(getBgClassName(name, defaultColorName).bgClassName);
				}
			}
		});
		var windowHeight = window.innerHeight;
		var html = document.documentElement;
		var navbarCollapse = navbar.querySelector(Selector.NAVBAR_COLLAPSE);
		var colorRgb = utils.hexToRgb(getBgClassName(name, defaultColorName).color);
		var _window$getComputedSt = window.getComputedStyle(navbar),
			backgroundImage = _window$getComputedSt.backgroundImage;
		var transition = 'background-color 0.35s ease';
		navbar.style.backgroundImage = 'none';
		window.addEventListener(Events.SCROLL, function () {
			var scrollTop = html.scrollTop;
			var alpha = scrollTop / windowHeight * 2;
			alpha >= 1 && (alpha = 1);
			navbar.style.backgroundColor = "rgba(".concat(colorRgb[0], ", ").concat(colorRgb[1], ", ").concat(colorRgb[2], ", ").concat(alpha, ")");
			navbar.style.backgroundImage = alpha > 0 || utils.hasClass(navbarCollapse, 'show') ? backgroundImage : 'none';
		});
		utils.resize(function () {
			var breakPoint = utils.getBreakpoint(navbar);
			if (window.innerWidth > breakPoint) {
				removeNavbarBgClass();
				navbar.style.backgroundImage = html.scrollTop ? backgroundImage : 'none';
				navbar.style.transition = 'none';
			} else if (!utils.hasClass(navbar.querySelector(Selector.NAVBAR_TOGGLER), ClassNames.COLLAPSED)) {
				removeNavbarBgClass();
				navbar.style.backgroundImage = backgroundImage;
			}
			if (window.innerWidth <= breakPoint) {
				navbar.style.transition = utils.hasClass(navbarCollapse, 'show') ? transition : 'none';
			}
		});
		navbarCollapse.addEventListener(Events.SHOW_BS_COLLAPSE, function () {
			navbar.classList.add(getBgClassName(name, defaultColorName).bgClassName);
			navbar.style.backgroundImage = backgroundImage;
			navbar.style.transition = transition;
		});
		navbarCollapse.addEventListener(Events.HIDE_BS_COLLAPSE, function () {
			removeNavbarBgClass();
			!html.scrollTop && (navbar.style.backgroundImage = 'none');
		});
		navbarCollapse.addEventListener(Events.HIDDEN_BS_COLLAPSE, function () {
			navbar.style.transition = 'none';
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                                 Navbar top                                 */
/* -------------------------------------------------------------------------- */
var navbarTopDropShadow = function navbarTopDropShadow() {
	var Selector = {
		NAVBAR: '.navbar:not(.navbar-vertical)',
		NAVBAR_VERTICAL: '.navbar-vertical',
		NAVBAR_VERTICAL_CONTENT: '.navbar-vertical-content',
		NAVBAR_VERTICAL_COLLAPSE: 'navbarVerticalCollapse'
	};
	var ClassNames = {
		NAVBAR_GLASS_SHADOW: 'navbar-glass-shadow',
		SHOW: 'show'
	};
	var Events = {
		SCROLL: 'scroll',
		SHOW_BS_COLLAPSE: 'show.bs.collapse',
		HIDDEN_BS_COLLAPSE: 'hidden.bs.collapse'
	};
	var navDropShadowFlag = true;
	var $navbar = document.querySelector(Selector.NAVBAR);
	var $navbarVertical = document.querySelector(Selector.NAVBAR_VERTICAL);
	var $navbarVerticalContent = document.querySelector(Selector.NAVBAR_VERTICAL_CONTENT);
	var $navbarVerticalCollapse = document.getElementById(Selector.NAVBAR_VERTICAL_COLLAPSE);
	var html = document.documentElement;
	var breakPoint = utils.getBreakpoint($navbarVertical);
	var setDropShadow = function setDropShadow($elem) {
		if ($elem.scrollTop > 0 && navDropShadowFlag) {
			$navbar && $navbar.classList.add(ClassNames.NAVBAR_GLASS_SHADOW);
		} else {
			$navbar && $navbar.classList.remove(ClassNames.NAVBAR_GLASS_SHADOW);
		}
	};
	window.addEventListener(Events.SCROLL, function () {
		setDropShadow(html);
	});
	if ($navbarVerticalContent) {
		$navbarVerticalContent.addEventListener(Events.SCROLL, function () {
			if (window.outerWidth < breakPoint) {
				navDropShadowFlag = true;
				setDropShadow($navbarVerticalContent);
			}
		});
	}
	if ($navbarVerticalCollapse) {
		$navbarVerticalCollapse.addEventListener(Events.SHOW_BS_COLLAPSE, function () {
			if (window.outerWidth < breakPoint) {
				navDropShadowFlag = false;
				setDropShadow(html);
			}
		});
	}
	if ($navbarVerticalCollapse) {
		$navbarVerticalCollapse.addEventListener(Events.HIDDEN_BS_COLLAPSE, function () {
			if (utils.hasClass($navbarVerticalCollapse, ClassNames.SHOW) && window.outerWidth < breakPoint) {
				navDropShadowFlag = false;
			} else {
				navDropShadowFlag = true;
			}
			setDropShadow(html);
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                               Navbar vertical                              */
/* -------------------------------------------------------------------------- */
var handleNavbarVerticalCollapsed = function handleNavbarVerticalCollapsed() {
	var Selector = {
		HTML: 'html',
		NAVBAR_VERTICAL_TOGGLE: '.navbar-vertical-toggle',
		NAVBAR_VERTICAL_COLLAPSE: '.navbar-vertical .navbar-collapse',
		ECHART_RESPONSIVE: '[data-echart-responsive]'
	};
	var Events = {
		CLICK: 'click',
		MOUSE_OVER: 'mouseover',
		MOUSE_LEAVE: 'mouseleave',
		NAVBAR_VERTICAL_TOGGLE: 'navbar.vertical.toggle'
	};
	var ClassNames = {
		NAVBAR_VERTICAL_COLLAPSED: 'navbar-vertical-collapsed',
		NAVBAR_VERTICAL_COLLAPSED_HOVER: 'navbar-vertical-collapsed-hover'
	};
	var navbarVerticalToggle = document.querySelector(Selector.NAVBAR_VERTICAL_TOGGLE);
	var html = document.querySelector(Selector.HTML);
	var navbarVerticalCollapse = document.querySelector(Selector.NAVBAR_VERTICAL_COLLAPSE);
	if (navbarVerticalToggle) {
		navbarVerticalToggle.addEventListener(Events.CLICK, function (e) {
			navbarVerticalToggle.blur();
			html.classList.toggle(ClassNames.NAVBAR_VERTICAL_COLLAPSED);
			var isNavbarVerticalCollapsed = utils.getItemFromStore('isNavbarVerticalCollapsed');
			utils.setItemToStore('isNavbarVerticalCollapsed', !isNavbarVerticalCollapsed);
			var event = new CustomEvent(Events.NAVBAR_VERTICAL_TOGGLE);
			e.currentTarget.dispatchEvent(event);
		});
	}
	if (navbarVerticalCollapse) {
		navbarVerticalCollapse.addEventListener(Events.MOUSE_OVER, function () {
			if (utils.hasClass(html, ClassNames.NAVBAR_VERTICAL_COLLAPSED)) {
				html.classList.add(ClassNames.NAVBAR_VERTICAL_COLLAPSED_HOVER);
			}
		});
		navbarVerticalCollapse.addEventListener(Events.MOUSE_LEAVE, function () {
			if (utils.hasClass(html, ClassNames.NAVBAR_VERTICAL_COLLAPSED_HOVER)) {
				html.classList.remove(ClassNames.NAVBAR_VERTICAL_COLLAPSED_HOVER);
			}
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                                   Popover                                  */
/* -------------------------------------------------------------------------- */
var popoverInit = function popoverInit() {
	var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
	popoverTriggerList.map(function (popoverTriggerEl) {
		return new window.bootstrap.Popover(popoverTriggerEl);
	});
};

/* -------------------------------------------------------------------------- */
/*                         Bootstrap animated progress                        */
/* -------------------------------------------------------------------------- */
var progressAnimationToggle = function progressAnimationToggle() {
	var animatedProgress = document.querySelectorAll('[data-progress-animation]');
	animatedProgress.forEach(function (progress) {
		progress.addEventListener('click', function (e) {
			var progressID = utils.getData(e.currentTarget, 'progressAnimation');
			var $progress = document.getElementById(progressID);
			$progress.classList.toggle('progress-bar-animated');
		});
	});
};

/* -------------------------------------------------------------------------- */
/*                                Scroll to top                               */
/* -------------------------------------------------------------------------- */
var scrollToTop = function scrollToTop() {
	document.querySelectorAll('[data-anchor] > a, [data-scroll-to]').forEach(function (anchor) {
		anchor.addEventListener('click', function (e) {
			var _utils$getData2;
			e.preventDefault();
			var el = e.target;
			var id = utils.getData(el, 'scroll-to') || el.getAttribute('href');
			window.scroll({
				top: (_utils$getData2 = utils.getData(el, 'offset-top')) !== null && _utils$getData2 !== void 0 ? _utils$getData2 : utils.getOffset(document.querySelector(id)).top - 100,
				left: 0,
				behavior: 'smooth'
			});
			window.location.hash = id;
		});
	});
};

/* -------------------------------------------------------------------------- */
/*                                 Scrollbars                                 */
/* -------------------------------------------------------------------------- */
var scrollbarInit = function scrollbarInit() {
	Array.prototype.forEach.call(document.querySelectorAll('.scrollbar-overlay'), function (el) {
		return new window.OverlayScrollbars(el, {
			scrollbars: {
				autoHide: 'leave',
				autoHideDelay: 200
			}
		});
	});
};

/* -------------------------------------------------------------------------- */
/*                                Theme control                               */
/* -------------------------------------------------------------------------- */
var initialDomSetup = function initialDomSetup(element) {
	if (!element) return;
	var dataUrlDom = element.querySelector('[data-theme-control = "navbarPosition"]');
	var hasDataUrl = dataUrlDom ? getData(dataUrlDom, 'page-url') : null;
	element.querySelectorAll('[data-theme-control]').forEach(function (el) {
		var inputDataAttributeValue = getData(el, 'theme-control');
		var localStorageValue = getItemFromStore(inputDataAttributeValue);
		if (inputDataAttributeValue === 'navbarStyle' && !hasDataUrl && getItemFromStore('navbarPosition') === 'top') {
			el.setAttribute('disabled', true);
		}
		if (el.type === 'checkbox') {
			if (inputDataAttributeValue === 'theme') {
				localStorageValue === 'dark' && el.setAttribute('checked', true);
			} else {
				localStorageValue && el.setAttribute('checked', true);
			}
		} else {
			var isChecked = localStorageValue === el.value;
			isChecked && el.setAttribute('checked', true);
		}
	});
};

var changeTheme = function changeTheme(element) {
	element.querySelectorAll('[data-theme-control = "theme"]').forEach(function (el) {
		var inputDataAttributeValue = getData(el, 'theme-control');
		var localStorageValue = getItemFromStore(inputDataAttributeValue);
		if (el.type === 'checkbox') {
			localStorageValue === 'dark' ? el.checked = true : el.checked = false;
		} else {
			localStorageValue === el.value ? el.checked = true : el.checked = false;
		}
	});
};

var themeControl = function themeControl() {
	var themeController = new DomNode(document.body);
	var navbarVertical = document.querySelector('.navbar-vertical');
	initialDomSetup(themeController.node);
	themeController.on('click', function (e) {
		var target = new DomNode(e.target);
		if (target.data('theme-control')) {
			var control = target.data('theme-control');
			var value = e.target[e.target.type === 'radio' ? 'value' : 'checked'];
			if (control === 'theme') {
				typeof value === 'boolean' && (value = value ? 'dark' : 'light');
			}
			setItemToStore(control, value);
			switch (control) {
				case 'theme':
					{
						document.documentElement.classList[value === 'dark' ? 'add' : 'remove']('dark');
						var clickControl = new CustomEvent('clickControl', {
							detail: {
								control: control,
								value: value
							}
						});
						e.currentTarget.dispatchEvent(clickControl);
						changeTheme(themeController.node);
						break;
					}
				case 'navbarStyle':
					{
						navbarVertical.classList.remove('navbar-card');
						navbarVertical.classList.remove('navbar-inverted');
						navbarVertical.classList.remove('navbar-vibrant');
						if (value !== 'transparent') {
							navbarVertical.classList.add("navbar-".concat(value));
						}
						break;
					}
				case 'navbarPosition':
					{
						var pageUrl = getData(target.node, 'page-url');
						pageUrl ? window.location.replace(pageUrl) : window.location.reload();
						break;
					}
				default:
					window.location.reload();
			}
		}
	});
};

/* -------------------------------------------------------------------------- */
/*                                    Toast                                   */
/* -------------------------------------------------------------------------- */
var toastInit = function toastInit() {
	var toastElList = [].slice.call(document.querySelectorAll('.toast'));
	toastElList.map(function (toastEl) {
		return new window.bootstrap.Toast(toastEl);
	});
	var liveToastBtn = document.getElementById('liveToastBtn');
	if (liveToastBtn) {
		var liveToast = new window.bootstrap.Toast(document.getElementById('liveToast'));
		liveToastBtn.addEventListener('click', function () {
			liveToast && liveToast.show();
		});
	}
};

/* -------------------------------------------------------------------------- */
/*                                   Tooltip                                  */
/* -------------------------------------------------------------------------- */
var tooltipInit = function tooltipInit() {
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
	tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new window.bootstrap.Tooltip(tooltipTriggerEl, {
			trigger: 'hover'
		});
	});
};

docReady(detectorInit);
docReady(handleNavbarVerticalCollapsed);
docReady(navbarTopDropShadow);
docReady(tooltipInit);
docReady(popoverInit);
docReady(toastInit);
docReady(progressAnimationToggle);
docReady(glightboxInit);
docReady(choicesInit);
docReady(formValidationInit);
docReady(countupInit);
docReady(copyLink);
docReady(navbarDarkenOnScroll);
docReady(scrollToTop);
docReady(navbarComboInit);
docReady(themeControl);
docReady(dropdownOnHover);
docReady(scrollbarInit);
docReady(iconCopiedInit);
docReady(dropdownMenuInit);