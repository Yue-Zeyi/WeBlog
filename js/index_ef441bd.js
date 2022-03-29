function getOsType() { var e = ""; return e = /(iPhone|iPad|iPod|iOS)/i.test(navigator.userAgent) ? "ios" : /(Android)/i.test(navigator.userAgent) ? "android" : "pc" }

function getUrlArgObject(e) {
    e || (e = "search");
    for (var r = new Object, i = "search" == e ? location.search.substring(1) : location.hash.substring(1), a = i.split("&"), n = 0; n < a.length; n++) {
        var t = a[n].indexOf("=");
        if (-1 != t) {
            var s = a[n].substring(0, t),
                o = a[n].substring(t + 1);
            r[s] = unescape(o)
        }
    }
    return r
}
var browserUserAgent = navigator.userAgent.toLowerCase(),
    isWeixinWrapper = "micromessenger" == browserUserAgent.match(/MicroMessenger/i);
! function(e) {
    e(function() {
        var r = getOsType();
        if (isWeixinWrapper) {
            var i = e('<div id="pop-weixin"></div>');
            e("body").append(i)
        }
        var a = e(".btn-getstart-big");
        if (e(".carousel").carousel(), "pc" == r) {
            var n = e("header.navbar"),
                t = e(".gotop");
            window.pageYOffset > 450 ? n.removeClass("navbar-bg") : n.addClass("navbar-bg"), window.pageYOffset < 600 ? t.fadeOut() : t.fadeIn(), e(window).scroll(function() { window.pageYOffset > 450 ? n.removeClass("navbar-bg") : n.addClass("navbar-bg"), window.pageYOffset < 600 ? t.fadeOut() : t.fadeIn() }), t.on("click", function() { e(window).scrollTo(0, 800) })
        } else e("body").addClass("os-mobile"), "ios" == r ? (a.text("立即加入"), a.attr("href", "https://jq.qq.com/?_wv=1027&k=BkVMOzgx")) : (a.text("立即加入"), urlArgs = getUrlArgObject("search"), urlArgs.qd && "weixin" == urlArgs.qd ? a.attr("href", "https://jq.qq.com/?_wv=1027&k=BkVMOzgx") : a.attr("href", "https://jq.qq.com/?_wv=1027&k=BkVMOzgx"));
        var s = isWeixinWrapper ? r + "-weixin" : r;
        a.on("click", function() { return _hmt.push(["_trackEvent", "home-banner-getstart", "click", s]), isWeixinWrapper && "ios" != r ? (e("#pop-weixin").fadeIn(), e("body").addClass("disable-scroll"), !1) : void 0 }), e("#pop-weixin").on("click", function() { e(this).fadeOut(), e("body").removeClass("disable-scroll") })
    })
}(jQuery, Modernizr);