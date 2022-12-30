jQuery(document).ready(function(){
	$ = jQuery.noConflict();

	$('#crypto_custom_css').each(function(e) {
		while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
			$(this).height($(this).height()+1);
		};
	}).css('overflow','hidden');

	$('#crypto_custom_css').keyup(function(e) {
		while($(this).outerHeight() < this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth"))) {
			$(this).height($(this).height()+1);
		};
	});

	function select_all(el) {
        if (typeof window.getSelection != "undefined" && typeof document.createRange != "undefined") {
            var range = document.createRange();
            range.selectNodeContents(el);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        } else if (typeof document.selection != "undefined" && typeof document.body.createTextRange != "undefined") {
            var textRange = document.body.createTextRange();
            textRange.moveToElementText(el);
            textRange.select();
        }
    }
	$('.mcwp-shortcode div,.type-mcwp .column-shortcode code').click(function(){
		select_all(this);
	});
	if($('.crypto-edit').length > 0){
		var beastVal = [];
		$('#select-beast option').each(function(i){
			if(i > 0){
				beastVal.push($(this).val());
			}
		});

		function range(end){
			var fullrange = [];
			
			for(var i=1; i<=end; i++) {
				fullrange.push(beastVal[i-1]);
			}
			return fullrange;
		}

		$select = $('#select-beast').selectize({
			labelField: 'label',
			valueField: 'value',
			searchField: ['label','value'],
			plugins: ['remove_button'],
			delimiter: ',',
			persist: false,
			create: false
		});

		control = $select[0].selectize;

		control.on('item_add',function(){
			setTimeout(function(){
				$(".selectize-select").val($(".selectize-select option:first").val());
			},50);
			if($('.mcwp-rate').length > 0){
				$('.mcwp-rate').slideDown();
			}
		});

		$('.selectize-select').on('change',function(){
			control.clear();
			if($('.mcwp-rate').length > 0){
				$('.mcwp-rate').slideDown();
			}
		});

		$('.removecoins').on('click',function(){
			$(".selectize-select").val($(".selectize-select option:first").val());
			control.clear();
		});
		
		$('.form-radio .img-pro').click(function(){
			$('.prodemo img').each(function(){
				var imgsrc = $(this).attr('src');
				imgsrc = imgsrc.replace('-checked','-unchecked');
				$(this).attr('src',imgsrc);
			});
			$(this).find('img').attr('src',$(this).find('img').attr('src').replace('-unchecked','-checked'));
			$('.crypto-rows[class*=position]').addClass('cc-hide');
			$('.'+$.trim($(this).find('img').data('name'))+'-position').removeClass('cc-hide');
		});
		$('.crypto-edit input[type=radio][name=crypto_ticker]').change(function() {
			$('.crypto-rows[class*=position]').addClass('cc-hide');
			$('label[for="crypto_background_color"]').hide();
			
			if(this.value != 'chart') {
				$('label[for="crypto_background_color"]:last-child').show();
			} else {
				$('label[for="crypto_background_color"]:first-child').show();
			}
			
			if (this.value == 'ticker') {
				$('.ticker-position').removeClass('cc-hide');
			} else if (this.value == 'table') {
				$('.table-position').removeClass('cc-hide');
			} else if (this.value == 'card') {
				$(".selectize-select").val($(".selectize-select option:first").val());
				$('.card-position').removeClass('cc-hide');
			} else if (this.value == 'label') {
				$(".selectize-select").val($(".selectize-select option:first").val());
				$('.label-position').removeClass('cc-hide');
			} else if (this.value == 'chart') {
				$('.chart-position').removeClass('cc-hide');
				$('label[for="crypto_background_color"]:first-child').show();
			} else if (this.value == 'converter') {
				$('.converter-position').removeClass('cc-hide');
			} else if (this.value == 'list') {
				$('.list-position').removeClass('cc-hide');
			} else if (this.value == 'box') {
				$('.box-position').removeClass('cc-hide');
			} else if (this.value == 'text') {
				$('.text-position').removeClass('cc-hide');
			}
			
			$('.prodemo img').each(function(){
				var imgsrc = $(this).attr('src');
				imgsrc = imgsrc.replace('-checked','-unchecked');
				$(this).attr('src',imgsrc);
			});
		});
		
		$('.crypto-edit input[type=radio][name=crypto_ticker_position]').change(function() {
			$('.crypto-edit input[type=radio][name=crypto_ticker_position]').each(function(){
				allimgsrc = $(this).closest('label').find('img').attr('src');
				allimgsrc = allimgsrc.replace('.png','').replace('hover','') + '.png';
				$(this).closest('label').find('img').attr('src',allimgsrc);
			});
			
			var curimg = $(this).closest('label').find('img').attr('src');
			curimg = curimg.replace('.png','') + 'hover' + '.png';
			$(this).closest('label').find('img').attr('src',curimg);
		});
		
		$('.crypto-edit input[type=radio][name="crypto_ticker_color"]').change(function() {
			$('.crypto-edit input[type=radio][name="crypto_ticker_color"]').closest('label').removeClass('cc-active');
			$(this).closest('label').addClass('cc-active');
		});
		$('.crypto-edit input[type=radio][name="crypto_table_style"]').change(function() {
			$('.crypto-edit input[type=radio][name="crypto_table_style"]').closest('label').removeClass('cc-active');
			$(this).closest('label').addClass('cc-active');
		});
		$('.crypto-edit input[type=radio][name="crypto_card_color"]').change(function() {
			$('.crypto-edit input[type=radio][name="crypto_card_color"]').closest('label').removeClass('cc-active');
			$(this).closest('label').addClass('cc-active');
		});

		$('.color-field').wpColorPicker();

		var rangeSlider = function(){
			var slider = $('.range-slider'),
				range = $('.range-slider__range'),
				value = $('.range-slider__value'),
				seconds = '';

			slider.each(function(){

				value.each(function(){
					var value = $(this).prev().attr('value');
					if($(this).prev().attr('id') == 'crypto_speed'){
						seconds = '%';
					} else {
						seconds = '';
					}
					$(this).html(value+seconds);
				});

				range.on('input', function(){
					if($(this).attr('id') == 'crypto_speed'){
						seconds = '%';
					} else {
						seconds = '';
					}
					$(this).next(value).html(this.value+seconds);
				});
			});
		};

		rangeSlider();
	}

	//dimissable notice

	$(document).on('click', '.mcwp-rate .mcwp-rate-close', function() {
		var $mcwprate = $(this).closest('.mcwp-rate');
		
		$mcwprate.slideUp();
		setTimeout(function(){
			$mcwprate.addClass("mcwp-hidefull");
		}, 500);

		$.ajax({
			url: ajaxurl,
			data: {
				action: 'mcwp_notice'
			}
		})
	});
	$(document).on('click', '.mcwp-notice .notice-dismiss, .mcwp-notice .mcwp-done', function() {
		var $mcwprate = $(this).closest('.mcwp-notice');
		
		$mcwprate.slideUp();
		$.ajax({
			url: ajaxurl,
			data: {
				action: 'mcwp_top_notice'
			}
		})
	});
});