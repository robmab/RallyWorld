(function($) {
	
    var coins = {};
	
	function addCommas(nStr){
		nStr += '';
		var x = nStr.split('.');
		var x1 = x[0];
		var x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
    }

	function hex2rgb(hex, opac) {
  
        hex = hex.replace('#','');
      
        if (hex.length === 3) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
      
        var r = parseInt(hex.substring(0,2), 16);
        var g = parseInt(hex.substring(2,4), 16);
        var b = parseInt(hex.substring(4,6), 16);
      
        if (isNaN(r) || isNaN(g) || isNaN(b)) {
          return new Error('Invalid Hex');
        } else if (opac !== undefined) {
          r = Math.round(((1 - opac) * 255) + (opac * r));
          g = Math.round(((1 - opac) * 255) + (opac * g));
          b = Math.round(((1 - opac) * 255) + (opac * b));
          return 'rgb('+r+','+g+','+b+')';
        } else {
          return 'rgb('+r+','+g+','+b+')';
        }
      
    }
	
	function commarize(data){
		
		formats = [' Trillion',' Billion',' Million','Thousand'];

		return (Math.abs(Number(data).toFixed(2)) >= 1.0e+15)
		? (Math.abs(Number(data)) / 1.0e+12).toFixed(2) + formats[0]
		: Math.abs(Number(data)) >= 1.0e+9
		? (Math.abs(Number(data)) / 1.0e+9).toFixed(2) + formats[1]
		: Math.abs(Number(data)) >= 1.0e+6
		? (Math.abs(Number(data)) / 1.0e+6).toFixed(2) + formats[2]
		: Math.abs(Number(data)) >= 1.0e+3
		? (Math.abs(Number(data)) / 1.0e+3).toFixed(2) + formats[3]
		: addCommas(Math.abs(Number(data)));
	}
	
	if($('.cryptoboxes').length > 0){
		
		$.fn.extend({
		  animateCss: function(animationName, callback) {
			var animationEnd = (function(el) {
			  var animations = {
				animation: 'animationend',
				OAnimation: 'oAnimationEnd',
				MozAnimation: 'mozAnimationEnd',
				WebkitAnimation: 'webkitAnimationEnd',
			  };

			  for (var t in animations) {
				if (el.style[t] !== undefined) {
				  return animations[t];
				}
			  }
			})(document.createElement('div'));

			this.addClass('mcwp-animated ' + animationName).one(animationEnd, function() {
			  $(this).removeClass('mcwp-animated ' + animationName);

			  if (typeof callback === 'function') callback();
			});

			return this;
		  },
		});
		
		$.fn.mcwpTable = function(options) {

			var opts = $.extend({
				length: this.data('length'),
				theme: this.data('theme'),
				color: (this.data('color') == '') ? '#222' : this.data('color'),
				bgColor: (this.data('bgcolor') == '') ? '#dd3333' : this.data('bgcolor')
			}, options);

			this.addClass(opts.theme);
			this.addClass('no-wrap');
			
			this.find('thead th').css('color', opts.color);

			if (opts.theme == 'custom') {
				this.find('th').css('background-color', opts.bgColor);
                this.css('background-color', hex2rgb(opts.bgColor, 0.1));
			}

			var coins={};
			
			var table = $(this).DataTable({
				responsive: true,
				searching: false,
				paging: true,
				lengthChange: false,
				pagingType: 'simple',
				pageLength: parseInt(opts.length),
				processing: true,
				serverSide: true,
				autoWidth: false,
				"ajax": {
					url: mcwpajax.ajax_url,
					"data": {
						action : "mcwp_table",
						mcwp_id : $(this).closest('.cryptoboxes').attr('id').split('-')[1]
					}
				},
				
				drawCallback: function(data) {

					coins = {};

					for (var i = 0; i < data.json.data.length; i++) {
						var row = data.json.data[i];
						coins[row.symbol] = row;
						coins[row.symbol]['rowId'] = i;
                    }

				},
				responsive: true,
				columnDefs: [
					{
						targets: 0,
						data: 'id',
						name: 'id',
						render: function(data, type, row, meta) {
							return data;
						}
					},
					{
						targets: 1,
						data: 'name',
						name: 'name',
						render: function(data, type, row, meta) {
                            return '<div class="mcwp-card-head"><div><img src="//s2.coinmarketcap.com/static/img/coins/32x32/' + row.imgpath + '.png" class="mcwp-coinimage"> <p>' + data + '</p></div></div>';
						}
					},
					{
						targets: 2,
						data: 'price',
						name: 'price_usd',
						render: function(data, type, row, meta) {
							var num = parseFloat(data).toFixed(10);

							if((num >= 1) || (num == 0)){
							   num = parseFloat(num).toFixed(2);
							} else if (num > 0) {
							   zerocount = num.toString().length - Number(num.toString().split('.')[1]).toString().length - 2;
							   count = zerocount > 5 ? 8 : 6;
							   num = parseFloat(num).toFixed(count);
							}
							return '$ '+addCommas(num);
						}
					},
					{
						targets: 3,
						data: 'mcap',
						name: 'market_cap_usd',
						render: function(data, type, row, meta) {
							var num = data;
							return '$ '+commarize(num);
						}
					},
					{
						targets: 4,
						data: 'change',
						name: 'percent_change_24h',
						render: function(data, type, row, meta) {
							var up = (data > 0) ? 'up mcwp-green' : 'down mcwp-red';
							return '<small class="micon-arrow-'+up+'"> ' + Math.abs(data) + '%</small>';
						}
					},
					{
						targets: 5,
						data: 'weekly',
						orderable: false,
						render: function(data, type, row, meta) {

                            newdata = [];
                            for(var i = 0; i < data.length; i += 1) {
								newdata.push(data[i]);
                            }
							
							var points = [];

							var min = Math.min.apply(null, newdata),
							max = Math.max.apply(null, newdata);
							var difference = max - min;

							for (var i = 0; i < newdata.length; i++) {
								var x = i*14;
								var y = isNaN((newdata[i] - min) / difference) ? 0 : ((newdata[i] - min) / difference) * 100;
								y = 100 - y;
								points.push(x + "," + y.toFixed(0));
							}

							return '<svg viewBox="0 0 336 110" width="116" height="35"><polyline fill="none" stroke="#7093fe" stroke-width="6" points="' + points.join(' ') + '"></polyline></svg>';
						}
					}
				],
				language: {
				  processing: '',
				  paginate: {
					next: 'Next <span class="micon-arrow-circle-o-right"></span>',
					previous: '<span class="micon-arrow-circle-o-left"></span> Back'  
				  }
				}
			});
			
			table.on('processing.dt', function ( e, settings, processing ) {
			   if (processing) {
				   $(this).addClass('table-processing');
			   } else {
					$(this).removeClass('table-processing');
					$('.dataTables_processing').css('top', '-45px');
			   }
			});
			
			$(table.table().container()).addClass('mcwp-table');
		}
	}
}(jQuery));


jQuery(document).ready(function(){
	$ = jQuery.noConflict();
	
	function isBrightness($that){
		var c = rgb2hex($that.css('background-color'));
		var rgb = parseInt(c.substring(1), 16);
		var r = (rgb >> 16) & 0xff;
		var g = (rgb >>  8) & 0xff;
		var b = (rgb >>  0) & 0xff;

		var luma = 0.2126 * r + 0.7152 * g + 0.0722 * b;

		if (luma < 40) {
			$that.addClass('invert-act');
		}
	}

	$('.cc-ticker,.mcwp-card,.mcwp-label').each(function(){
		isBrightness($(this));

		var invertList = ['ripple','iota','eos','0x','bancor','dentacoin','bibox-token','medishares','santiment','quantstamp','raiden-network-token','pillar','republic-protocol','metal','eidoo','credo','blackmoon','covesting','shivom','suncontract','numeraire','daostack','bitdegree','matryx','faceter','internxt','cryptoping','invacio','chainium','creativecoin','trezarcoin','elcoin-el','jesus-coin','mojocoin','gapcoin','prime-xi','speedcash','veltor','loopring-neo','francs'];

		$(this).find('img').each(function(){
			if(invertList.join('-').toLowerCase().indexOf($(this).attr('alt').toLowerCase()) > -1) {
				$(this).addClass('invertable');
			}

		});
	});

	function rgb2hex(rgb){
		rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
		return (rgb && rgb.length === 4) ? "#" +
		("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
		("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
		("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
	}
	
	function getcontrast(hex) {
		var r = parseInt(hex.substr(1, 2), 16),
			g = parseInt(hex.substr(3, 2), 16),
			b = parseInt(hex.substr(5, 2), 16),
			yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
		return (yiq >= 128) ? 'rgba(0,0,0,0.25)' : 'rgba(255,255,255,0.25)';
	}
	
	$.fn.multiply = function(numCopies) {
		var newElements = this.clone();
		for(var i = 1; i < numCopies; i++)
		{
			newElements = newElements.add(this.clone());
		}
		return newElements;
	};
	

	$(window).load(function(){
		
		$('.cc-stats').each(function(){
			var listWidth = 0,
				$that = $(this);
			
				$(this).find('li').each(function() {
				listWidth += $(this).innerWidth();
			});
			
			clonedElem = $(this).find('li');
			var mult = $(this).innerWidth()/listWidth;
			$(this).append('<div class="cc-dup"></div>');
			
			if(mult > 0.5){
				$(this).find('.cc-dup').append(clonedElem.multiply(Math.ceil(mult)));
			} else {
				$(this).find('.cc-dup').append(clonedElem.multiply(1));
			}
			$(this).css('width',listWidth);

			var itemcount = $(this).find('li').length;
			var itemsize = listWidth / itemcount;

			var speed = $(this).closest('.mcwp-ticker').data('speed');
			var duration = itemsize * 10;

			if (speed === 200) {
				duration = 10;
			} else if (speed == 0) {
				duration = 0;
			} else if (speed > 100) {
				speed = speed - 100;
				speed = (speed / 10) * itemsize;
				duration = duration - speed;
			} else if (speed < 100) {
				speed = 100 - speed;
				speed = (speed / 10) * (itemsize * 8);
				duration = duration + speed;
			}

			var speed = (itemcount * duration) / 1000;
			$(this).css('animation-duration',  speed + 's');

			$(this).closest('.mcwp-ticker').slideDown().css('opacity','1');
		});
	});
	
    $('.mcwp-datatable').each(function(){
        $(this).mcwpTable();
	});

	if ($('.mcwp-ticker').length > 0) {
		if($('.mcwp-ticker').hasClass('mcwp-header')){
			var bodyHeight = parseInt($('body').css('margin-top')) + parseInt($('body').css('padding-top'));
			var htmlHeight = parseInt($('html').css('margin-top')) + parseInt($('html').css('padding-top'));
			var fixHeight = $('.mcwp-ticker').height() - (bodyHeight > 0  ? bodyHeight : '0')  - (htmlHeight > 0  ? htmlHeight : '0');
			if(fixHeight > 0)
				$('body').css('padding-top',fixHeight);
		}
	}
});