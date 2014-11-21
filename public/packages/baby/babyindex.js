;
(function($) {

	"use strict";

	// 定义
	var myvar = {
		'localurl' : window.location.href,
		'localhost' : window.location.host,
		'ajaxPhotos' : '/api/mybabyphotos',
		'babyUrl' : '/baby/',
		'page' : 1,
		'perpage' : 10
	};
	
	var oPage = {
		ui : {
			$babylist : $('#babylist'),
			$backtotop : $("#backtotop"),
			'container' : document.querySelector('#babylist'),
		},
		data : {
			pageData : null,
			isLoading : false,
			stopLoad : false
		},
		init : function() {
			this.fMasonry();
			this.fAjaxInfo();
			this.bindEvent();
		},
		bindEvent : function() {
			var $this = this;
			// 更多
			$(window).scroll(
					function() {
						// 当滚动到最底部以上100像素时， 加载新内容
						if ($(document).height() - $(this).scrollTop()
								- $(this).height() < 50) {

							if (!$this.data.stopLoad) {
								myvar.page = parseInt(myvar.page) + 1;
								$this.fAjaxInfo();

							}
						}

						if ($(this).scrollTop() > 200) {
							$this.ui.$backtotop.addClass('showme');
						}
					});

			// 返回顶部
			$this.ui.$backtotop.on('click', function() {
				$this.ui.$backtotop.removeClass('showme');
				$("html,body").animate({
					scrollTop : 0
				}, 1000);
				return false;
			});
		},
		fMasonry : function() {
			
			var msnry = new Masonry(this.ui.container, {
				// options
				columnWidth : '.col-xs-6',
				itemSelector : '.col-xs-6'
			});
			
			// check on load
			if (jQuery(window).width() <= 480)
				msnry.destroy();

			// check on resize
			jQuery(window).resize(function() {
				if (jQuery(this).width() <= 480)
					msnry.destroy();
			});

			// relayout items when clicking chat icon
			// jQuery('#chatview, .menutoggle').click(function(){
			// msnry.layout();
			// });
			$('.fancybox').fancybox({
				padding : 0,
				openEffect : 'elastic'
			});
		},
		fAjaxInfo : function() {
			var $this = this;
			if (!this.data.isLoading) {
				this.data.isLoading = true;
				$.get(myvar.ajaxPhotos, {
					"page" : myvar.page,
					"perpage" : myvar.perpage
				}, function(data) {
					if (data.code == 0) {
						var content = $this.packPhotos(data.data);
						$this.ui.$babylist.append(content);
						
						$this.fMasonry();
					}
					myvar.page = data.page;
					myvar.perpage = data.perpage;
					$this.data.isLoading = false;
				}, 'json');
			}
		},
		packPhotos : function(data) {
			if (data.length == 0) {
				this.data.stopLoad = true;
				return false;
			}
			var str = '';
			$.each(data, function(i, item) {
				str += '<div class="col-xs-6 col-sm-4 col-md-3">';
				str += '	<div class="blog-item">';
				str += '		<a href="' + item.largeImg + '" rel="baby" title="'
						+ item.title + '" class="blog-img fancybox">';
				str += '			<img src="' + item.smallImg
						+ '" class="img-responsive" alt="' + item.title + '">';
				str += '		</a>';
				str += '		<div class="blog-details">';
				str += '			<h4 class="blog-title">';
				str += '				<a href="javascript:void(0);">' + item.title
						+ '</a>';
				str += '			</h4>';
				str += '			<ul class="blog-meta">';
				str += '				<li>By: <a href="' + myvar.babyUrl + item.baby.id
						+ '">' + item.baby.nickname + '</a></li>';
				str += '				<li>' + item.take_at + '</li>';
				str += '			</ul>';
				str += '			<div class="blog-summary">';
				str += '				<p>' + item.desc + '</p>';
				str += '			</div>';
				str += '		</div>';
				str += '	</div>';
				str += '</div>';
			});
			return str;
		}
	};

	jQuery(window).load(function() {
		oPage.init();
	});
})(jQuery);