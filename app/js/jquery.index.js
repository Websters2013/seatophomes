"use strict";

( function(){

    $(function () {

        $.each($('.hero__video'), function () {
            new BgVideo($(this));
        });

    } );

    var BgVideo = function (obj) {

        var _self = this,
            _obj = obj,
            _window = $(window);

        var _addEvents = function () {

                _window.on({
                    resize: function () {
                        _setHeight();
                    }

                })

            },
            _setHeight = function () {

                var height = $('.ytplayer-container.background').height() - 10;

                _obj.height(height);

            },
            _addBgVideo = function () {

                var path = _obj.data('video');

                $('.video-bg').YTPlayer({
                    videoId: path,
                    fitToBackground: true,
                    mute: true
                });
            },
            _init = function () {
                _addBgVideo();
                _setHeight();
                _addEvents();
                _obj[ 0 ].obj = _self;

            };

        _init();

    };

} )();
