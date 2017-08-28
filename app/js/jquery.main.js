"use strict";
( function() {

    $( function() {

        $.each( $( '.account' ), function() {

            new MyAccount ( $( this ) );

        } );
        $.each( $( '.articles-list' ), function() {

            new ArticlesList ( $( this ) );

        } );
        $.each( $( '.site__aside' ), function() {

            new AsideMenu ( $( this ) );

        } );

    });

    var MyAccount = function( obj ) {

        //private properties
        var _self = this,
            _menu = obj;

        //private methods
        var _onEvents = function() {

                _menu.on( {
                    click: function() {

                        _openMenu( $( this ) );

                    }
                } );

                $(document).on(
                    "click",
                    ".account",
                    function( event ){
                        event = event || window.event;

                        if (event.stopPropagation) {
                            event.stopPropagation();
                        } else {
                            event.cancelBubble = true;
                        }
                    }
                );
                $(document).on(
                    "click",
                    "body",
                    function(){

                        if( _menu.hasClass( 'opened' ) ) {

                            _menu.removeClass( 'opened' );

                        }

                    }
                );

            },
            _openMenu = function( elem )  {

                var curItem = elem;

                if( curItem.hasClass( 'opened' ) ) {

                    curItem.removeClass( 'opened' );

                } else {

                    curItem.addClass( 'opened' );
                }

            },
            _init = function() {
                _menu[ 0 ].obj = _self;
                _onEvents();
            };

        _init();
    };

    var ArticlesList = function( obj ) {

        //private properties
        var _self = this,
            _menu = obj,
            _dropBtn = _menu.find('.drop>a');

        //private methods
        var _onEvents = function() {

                _dropBtn.on( {
                    click: function() {

                        _openMenu( $( this ) );

                        return false;

                    }
                } );

            },
            _openMenu = function( elem )  {

                var curItem = elem,
                    innerList = curItem.next('ul'),
                    realHeight = innerList[0].scrollHeight;

                if( curItem.parent().hasClass( 'opened' ) ) {

                    curItem.parent().removeClass( 'opened' );
                    innerList.height(0);
                    innerList.css( {
                        'min-height': 0,
                        height: 0
                    } );

                    if( curItem.parent().find('.opened') ) {

                        curItem.parent().find('.opened').removeClass('opened')
                        .find('>ul').css( {
                            'min-height': 0,
                            height: 0
                        } );

                    }

                } else {

                    curItem.parent().addClass( 'opened' );
                    innerList.height(realHeight);

                    innerList.css( {
                        'min-height': realHeight
                    } );
                    setTimeout( function() {

                        innerList.css( {
                            'height': 'auto'
                        } );

                    }, 310 );

                }

            },
            _recalculationHeight = function () {

                _dropBtn.each( function () {

                    var curItem = $(this),
                        innerList = curItem.next('ul'),
                        realHeight = innerList[0].scrollHeight;

                    if(curItem.parent().hasClass('opened')) {

                        innerList.css( {
                            'min-height': realHeight
                        } );
                        setTimeout( function() {

                            innerList.css( {
                                'height': 'auto'
                            } );

                        }, 310 );

                    }

                } );

            },
            _init = function() {
                _menu[ 0 ].obj = _self;
                _onEvents();
                _recalculationHeight();
            };

        _init();
    };

    var AsideMenu = function( obj ) {

        //private properties
        var _self = this,
            _menu = obj,
            _openBtn = $('.site__open-menu'),
            _closeBtn = _menu.find('.site__aside-hide');

        //private methods
        var _onEvents = function() {

                _openBtn.on( {
                    click: function() {

                        _openMenu();

                        return false;

                    }
                } );

                _closeBtn.on( {
                    click: function() {

                        _closeMenu();

                        return false;

                    }
                } );

            },
            _closeMenu = function() {

                _openBtn.removeClass('hidden');
                _menu.removeClass( 'opened' );
                _menu.css( {
                    'min-height': 0,
                    height: 0
                } );
                _checkMenu();

            },
            _openMenu = function() {
                var realHeight = _menu[0].scrollHeight;

                _openBtn.addClass('hidden');
                _menu.addClass( 'opened' );
                _menu.css( {
                    'min-height': realHeight
                } );
                setTimeout( function() {

                    _menu.css( {
                        'height': 'auto'
                    } );

                }, 310 );

                _checkMenu();

            },
            _checkMenu = function () {

                if( $(window).width() >= 768 ) {

                    if( !_menu.hasClass('opened') ) {

                        $('.site__content-wrap').find('>div').width('100%');

                    } else {

                        $('.site__content-wrap').find('>div').width('57%');

                    }

                }

            },
            _init = function() {
                _menu[ 0 ].obj = _self;
                _onEvents();
                _checkMenu();
            };

        _init();
    };

} )();
