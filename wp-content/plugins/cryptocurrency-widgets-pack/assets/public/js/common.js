// Peity jQuery plugin version 3.3.0
// (c) 2018 Ben Pickles
//
// http://benpickles.github.io/peity
//
// Released under MIT license.
!function(t,i,e,n){var a=t.fn.peity=function(i,e){return l&&this.each(function(){var n=t(this),h=n.data("_peity");h?(i&&(h.type=i),t.extend(h.opts,e)):(h=new r(n,i,t.extend({},a.defaults[i],n.data("peity"),e)),n.change(function(){h.draw()}).data("_peity",h)),h.draw()}),this},r=function(t,i,e){this.$el=t,this.type=i,this.opts=e},h=r.prototype,s=h.svgElement=function(e,n){return t(i.createElementNS("http://www.w3.org/2000/svg",e)).attr(n)},l="createElementNS"in i&&s("svg",{})[0].createSVGRect;h.draw=function(){var t=this.opts;a.graphers[this.type].call(this,t),t.after&&t.after.call(this,t)},h.fill=function(){var i=this.opts.fill;return t.isFunction(i)?i:function(t,e){return i[e%i.length]}},h.prepare=function(t,i){return this.$svg||this.$el.hide().after(this.$svg=s("svg",{class:"peity"})),this.$svg.empty().data("_peity",this).attr({height:i,width:t})},h.values=function(){return t.map(this.$el.text().split(this.opts.delimiter),function(t){return parseFloat(t)})},a.defaults={},a.graphers={},a.register=function(t,i,e){this.defaults[t]=i,this.graphers[t]=e},a.register("pie",{fill:["#ff9900","#fff4dd","#ffc66e"],radius:8},function(i){if(!i.delimiter){var n=this.$el.text().match(/[^0-9\.]/);i.delimiter=n?n[0]:","}var a=t.map(this.values(),function(t){return t>0?t:0});if("/"==i.delimiter){var r=a[0],h=a[1];a=[r,e.max(0,h-r)]}for(var l=0,p=a.length,o=0;l<p;l++)o+=a[l];o||(p=2,o=1,a=[0,1]);var f=2*i.radius,c=this.prepare(i.width||f,i.height||f),u=c.width()/2,d=c.height()/2,g=e.min(u,d),v=i.innerRadius;"donut"!=this.type||v||(v=.5*g);var m=e.PI,y=this.fill(),w=this.scale=function(t,i){var n=t/o*m*2-m/2;return[i*e.cos(n)+u,i*e.sin(n)+d]},x=0;for(l=0;l<p;l++){var k,$=a[l],j=$/o;if(0!=j){if(1==j)if(v){var A=u-.01,E=d-g,F=d-v;k=s("path",{d:["M",u,E,"A",g,g,0,1,1,A,E,"L",A,F,"A",v,v,0,1,0,u,F].join(" "),"data-value":$})}else k=s("circle",{cx:u,cy:d,"data-value":$,r:g});else{var M=x+$,S=["M"].concat(w(x,g),"A",g,g,0,j>.5?1:0,1,w(M,g),"L");v?S=S.concat(w(M,v),"A",v,v,0,j>.5?1:0,0,w(x,v)):S.push(u,d),x+=$,k=s("path",{d:S.join(" "),"data-value":$})}k.attr("fill",y.call(this,$,l,a)),c.append(k)}}}),a.register("donut",t.extend(!0,{},a.defaults.pie),function(t){a.graphers.pie.call(this,t)}),a.register("line",{delimiter:",",fill:"#c6d9fd",height:16,min:0,stroke:"#4d89f9",strokeWidth:1,width:32},function(t){var i=this.values();1==i.length&&i.push(i[0]);for(var a=e.max.apply(e,t.max==n?i:i.concat(t.max)),r=e.min.apply(e,t.min==n?i:i.concat(t.min)),h=this.prepare(t.width,t.height),l=t.strokeWidth,p=h.width(),o=h.height()-l,f=a-r,c=this.x=function(t){return t*(p/(i.length-1))},u=this.y=function(t){var i=o;return f&&(i-=(t-r)/f*o),i+l/2},d=u(e.max(r,0)),g=[0,d],v=0;v<i.length;v++)g.push(c(v),u(i[v]));g.push(p,d),t.fill&&h.append(s("polygon",{fill:t.fill,points:g.join(" ")})),l&&h.append(s("polyline",{fill:"none",points:g.slice(2,g.length-2).join(" "),stroke:t.stroke,"stroke-width":l,"stroke-linecap":"square"}))}),a.register("bar",{delimiter:",",fill:["#4D89F9"],height:16,min:0,padding:.1,width:32},function(t){for(var i=this.values(),a=e.max.apply(e,t.max==n?i:i.concat(t.max)),r=e.min.apply(e,t.min==n?i:i.concat(t.min)),h=this.prepare(t.width,t.height),l=h.width(),p=h.height(),o=a-r,f=t.padding,c=this.fill(),u=this.x=function(t){return t*l/i.length},d=this.y=function(t){return p-(o?(t-r)/o*p:1)},g=0;g<i.length;g++){var v,m=u(g+f),y=u(g+1-f)-m,w=i[g],x=d(w),k=x,$=x;o?w<0?k=d(e.min(a,0)):$=d(e.max(r,0)):v=1,0==(v=$-k)&&(v=1,a>0&&o&&k--),h.append(s("rect",{"data-value":w,fill:c.call(this,w,g,i),x:m,y:k,width:y,height:v}))}})}(jQuery,document,Math);

(function($) {
	
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
	
	function commarize(data){
		
		formats = [' Trillion',' Billion',' Million',' Thousand'];

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

	function rgb2hex(rgb){
		rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
		return (rgb && rgb.length === 4) ? "#" +
		("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
		("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
		("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
	}
	
	$.fn.multiply = function(numCopies) {
		var newElements = this.clone();
		for(var i = 1; i < numCopies; i++)
		{
			newElements = newElements.add(this.clone());
		}
		return newElements;
	};

	if($('.mcwp-crypto').length > 0){
		
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

			var coins = {};

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
						mcwp_id : $(this).closest('.mcwp-crypto').attr('id').split('-')[1]
					}
				},
				drawCallback: function(data) {

					coins = {};

					for (var i = 0; i < data.json.data.length; i++) {
						var row = data.json.data[i];
						coins[row.symbol] = row;
						coins[row.symbol]['rowId'] = i;
					}
					$.fn.peity.defaults.line = {
						delimiter: ",",
						fill: "#c6d9fd",
						height: '30',
						max: null,
						min: null,
						stroke: "transparent",
						strokeWidth: 1,
						width: '150'
					};
					$(".mcwp-line").peity("line");

				},
				responsive: true,
				columnDefs: [
					{
						targets: 0,
						data: 'rank',
						name: 'rank',
						render: function(data, type, row, meta) {
							return data;
						}
					},
					{
						targets: 1,
						data: 'name',
						name: 'name',
						render: function(data, type, row, meta) {
							var tabletd;
							tabletd	= '<div class="mcwp-card-head"><div><img src="' + row.imgpath + '" class="mcwp-coinimage"><p>';
							if(typeof row.link != 'undefined' && row.link === true) {
								tabletd	= tabletd + '<a rel="nofollow" href="https://coingecko.com/coins/'+row.cid+'" target="_blank">' + data + '</a>';
							} else {
								tabletd	= tabletd + data;
							}
							tabletd	= tabletd + '</p></div></div>';
							return tabletd;
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

							var spcls = (row.change > 0) ? 'green' : 'red';
							return '<span class="mcwp-line sp-'+spcls+'" style="display: none">'+data.join(',')+'</span>';
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

			table.on('responsive-display', function(e) {
				$.fn.peity.defaults.line = {
					delimiter: ",",
					fill: "#c6d9fd",
					height: '30',
					max: null,
					min: null,
					stroke: "transparent",
					strokeWidth: 1,
					width: '100%'
				};
				$(".mcwp-line").peity("line");
			});
			
			$(table.table().container()).addClass('mcwp-table');
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
	
		if ($('.mcwp-ticker').length > 0) {
			if($('.mcwp-ticker').hasClass('mcwp-header')){
				
				// var bodyHeight = parseInt($('body').css('margin-top')) + parseInt($('body').css('padding-top'));
				// var htmlHeight = parseInt($('html').css('margin-top')) + parseInt($('html').css('padding-top'));
				// var fixHeight = $('.mcwp-ticker').height() - bodyHeight - htmlHeight;
				var fixHeight = $('.mcwp-ticker').height();

				if(fixHeight > 0) {
					$('body').css('padding-top',fixHeight);
					$('#wpadminbar').css('margin-top',fixHeight);
				}
			}
		}
	});
	
    $('.mcwp-datatable').each(function(){
		$(this).mcwpTable();
	});
}(jQuery));