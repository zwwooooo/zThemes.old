jQuery(document).ready(function($){ //启用 jQ

/* ======== 伸缩栏效果 ======== */
$(".menuheader-open").click(function() {$(this).next().slideToggle(300);return false;});
$(".menuheader-open").toggle(function () {$(this).removeClass("menuheader-open").addClass("menuheader-closed");},function () {$(this).removeClass("menuheader-closed").addClass("menuheader-open");});
$(".menuheader-open:first").click();

$('.addcomments').click(function(){
	$('html,body').animate({scrollTop:jQuery('#respond').offset().top}, 'slow');return false;
});

/* ======== Sidebar Tab 切换 ======== */
$('#tab-title span').mouseover(function(){ //鼠标移至id="tab-title"下的span标签时，触发
	$(this).addClass("current").siblings().removeClass(); //给当前的添加class="current"，并且让其同辈元素（即其余#tab-title span）移除class="current"；
	$("."+$(this).attr("id")).show().siblings().hide(); //让class="鼠标移至的span的id"（即tab-content中对应ul中的内容）显示，并且让其同辈元素（即#tab-content ul）隐藏；
});

}); //结束jQuery