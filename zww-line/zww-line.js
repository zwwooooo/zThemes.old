/*
zww-line js
 */
jQuery(document).ready(function($){				//启用 jQ

$('.fn a,.nonelist a,.ffox_most_active a').attr({ target: "_blank"});  //对class=“fn”标签内的a中添加target: "_blank" 来自林木木
$('a,input[type="submit"],object').bind('focus',function(){if(this.blur){ this.blur();}});//可去除虛線框的jQ by willin

/* ======== 伸缩栏效果 by willin ======== */
//$(".toggle").css("display","none");//定义.toggle属性为隐藏
$(".menuheader").click(function() {$(this).next().slideToggle(300);return false;});
$(".expansion-1:first").click(); //模拟用户点击第一个.post-title的元素（即首篇文章） by 木木
//class点击替换 by zwwooooo
$(".expansion-1").toggle(function () {$(this).addClass("expansion-2");},function () {$(this).removeClass("expansion-2");});
$(".expansion-2").toggle(function () {$(this).removeClass("expansion-2").addClass("expansion-1");},function () {$(this).removeClass("expansion-1").addClass("expansion-2");});

/* ======== Gun 图片展示 by zww ========
$('#header-gun').mouseover(function(){
	$('#footer').after('<div id="header-gun-large" style="max-width:800px;height:auto;position:absolute;bottom:20000px;display:none;z-index:9999;"><img src="http://127.1/wordpress/wp-content/themes/zww-line/images/header-gun-large.jpg" /></div>');
	$('#header-gun-large').show(1000)
}).mousemove(function(e){$('#header-gun-large').css({left:e.pageX-400,top:e.pageY+50})
}).mouseout(function(){$('#header-gun-large').remove()
}); */

/* ======== RSS 下拉菜单 by zww 完善 by willin ======== */
$("#rss").hover(function(){if(!$(this).children("#rss-menu").is(":animated")){$(this).children("#rss-menu").slideDown("800");}},function(){$(this).children("#rss-menu").slideUp("400");});//willin

/* ======== 评论 2 级嵌套后的样式处理：放置在主评论下，用 @ 方式 by Jinwen Edit by zwwooooo ======== */
$('.depth-1').each(function() {
	var zzz = $(this).find('ul.children li.depth-2 > div');
	$(this).find(".reply:first").clone().removeClass("reply").addClass("atclass").appendTo(zzz);
});
$('.atclass').click(function() { //定义从属评论回复按钮被点击后的动作
	var atid = '"#' + $(this).parents(".depth-2").find('div').attr("id") + '"'; 
	var atname = $(this).parents(".depth-2").find('cite:first').text();
	$("#comment").attr("value","<a href=" + atid + ">@" + atname + " </a>").focus();
});
$('.reply').click(function() {
	var atid = '"#' + $(this).parents(".depth-1").find('div').attr("id") + '"'; 
	var atname = $(this).parents(".depth-1").find('cite:first').text();
	$("#comment").attr("value","<a href=" + atid + ">@" + atname + " </a>").focus();
});
$('.cancel-comment-reply a').click(function() { //点击取消回复评论清空评论框的内容
	$("#comment").attr("value",'');
});
// 实现鼠标移到 @用户 显示该用户的评论，限制主评论内 by zww
var commentid=/^#comment-/;
var commentat=/^@/;
jQuery('#thecomments li p a').each(function() {
	if(jQuery(this).attr('href').match(commentid)&& jQuery(this).text().match(commentat)) {
		jQuery(this).addClass('atreply');
	}
});
$('.atreply').mouseover(function(){
	var commentreplyid = $(this).attr('href');
	$('#footer').after('<div id="replyto" style="border:3px solid #9aa915;padding:10px;position:absolute;max-width:400px;height:auto;background:#fff;z-index:9999;display:none;">' + $(commentreplyid).find('p').html() + '</div>');
	$('#replyto').show(300)
}).mousemove(function(e){$('#replyto').css({left:e.pageX+15,top:e.pageY+15})
}).mouseout(function(){$('#replyto').remove()
});

/* ========top down 滚动效果 by 61dh.com edit by zww ======== */
$('#updown-up').click(function(){
	$('html,body').animate({scrollTop:0}, 'slow');return false; //返回false可以避免在原链接后加上#
});
$('#updown-comments').click(function(){
	$('html,body').animate({scrollTop:jQuery('#comments').offset().top}, 'slow');return false;
});
$('#updown-down').click(function(){
	$('html,body').animate({scrollTop:jQuery('#footer').offset().top}, 'slow');return false;
});

/* ======== Loading 效果 ======== */
$('h1#header-title a,#header-page a,#header-categories a,.postinfo a,.postinfo h2 a,p.read-more a,.commentslink1 a,.commentslink2 a,.loading a,#pagination a,.navigation a,#footer-inside .left,#zww-1').click(function(e){
	if(e.which == 2){
			return true;
	}else{
			window.location = $(this).attr('href');
			$('#loading').show(800);
			$(this).text('loading...');
		}
});

/* ======== Sidebar Tab 切换 by immmmm ======== */
$('#tab-title span').mouseover(function(){ //鼠标移至id="tab-title"下的span标签时，触发
	$(this).addClass("current").siblings().removeClass(); //给当前的添加class="current"，并且让其同辈元素（即其余#tab-title span）移除class="current"；
	$("."+$(this).attr("id")).show().siblings().hide(); //让class="鼠标移至的span的id"（即tab-content中对应ul中的内容）显示，并且让其同辈元素（即#tab-content ul）隐藏；
});

})												//结束jQuery