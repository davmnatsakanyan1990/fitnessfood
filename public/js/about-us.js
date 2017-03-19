    /*Home page left bar scroll function*/

function homePageSideBarScrollContainerFunction() {
    var winHeight = $(window).height();
    var winWidth = $(window).width();
    var filterNavmenuWrap = $(".navbar").height();
    var sideBarContHeight = $(".side-bar-cont").height();
    var leftBar = $(".side-bar");
    var leftBarHeight = leftBar.height();
    var leftBarWidth = leftBar.width() + 30;
    var scrollFlag = false;
    var footerScrollFlag = false;
    var bottPosition = false;
    var leftBarBlockOffTop = leftBar.offset().top;
    var footerBlockOffTop = $("footer").offset().top;
    var footerBlockHeight = $("footer").height();
    var leftBarStyles1 = {
        top: filterNavmenuWrap,
        width: leftBarWidth,
        bottom: "auto"
    };
    var leftBarStyles2 = {
        top: "auto",
        bottom: "auto"
    };
    var leftBarStyles3 = {
        width: leftBarWidth,
        top: "auto",
        bottom: footerBlockHeight + 50
    };
    var leftBarStyles4 = {
        width: leftBarWidth,
        top: "auto",
        bottom: "0"
    };

    function scrollBarFunction() {
        if (winWidth >= 990) {
            if (winHeight - filterNavmenuWrap >= leftBarHeight) {
                if ($(window).scrollTop() >= leftBarBlockOffTop && scrollFlag == false && footerScrollFlag == false) {
                    scrollFlag = true;
                    leftBar.addClass("fixed-side-bar");
                    leftBar.css(leftBarStyles1);
                } else if ($(window).scrollTop() <= leftBarBlockOffTop && scrollFlag == true) {
                    scrollFlag = false;
                    leftBar.removeClass("fixed-side-bar");
                    leftBar.css(leftBarStyles2);
                } else if ($(window).scrollTop() + winHeight - footerBlockHeight + 150 >= footerBlockOffTop && scrollFlag == true && footerScrollFlag == false) {
                    scrollFlag = false;
                    footerScrollFlag = true;
                    leftBar.css(leftBarStyles3);
                } else if ($(window).scrollTop() + winHeight - footerBlockHeight + 150 <= footerBlockOffTop && scrollFlag == false && footerScrollFlag == true) {
                    scrollFlag = true;
                    footerScrollFlag = false;
                    leftBar.css(leftBarStyles1);
                }
            } else if ($(window).scrollTop() >= leftBarHeight + filterNavmenuWrap - winHeight && bottPosition == false && footerScrollFlag == false) {
                bottPosition = true;
                leftBar.addClass("fixed-side-bar");
                leftBar.css(leftBarStyles4);
            } else if ($(window).scrollTop() <= leftBarHeight + filterNavmenuWrap - winHeight && bottPosition == true && footerScrollFlag == false) {
                bottPosition = false;
                footerScrollFlag = false;
                leftBar.removeClass("fixed-side-bar");
                leftBar.css(leftBarStyles2);
            } else if ($(window).scrollTop() + winHeight - footerBlockHeight + 300 >= footerBlockOffTop && bottPosition == true && footerScrollFlag == false) {
                footerScrollFlag = true;
                leftBar.css(leftBarStyles3);
            } else if ($(window).scrollTop() + winHeight - footerBlockHeight + 300 <= footerBlockOffTop && bottPosition == true && footerScrollFlag == true) {
                bottPosition = false;
                footerScrollFlag = false;
                leftBar.css(leftBarStyles4);

            }
        }
    }

    scrollBarFunction();

    $(window).scroll(function () {
        scrollBarFunction();
    });
}

homePageSideBarScrollContainerFunction();


/*Home page left bar scroll function END*/
