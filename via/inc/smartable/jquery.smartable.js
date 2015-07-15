/* Copyright (c) 2012 Frédéric Legembre (http://chabada.org)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 * Version: 0.2
 *
 * Remarques:
 * - comments with /// are todo
 * - if you use thead, you will go to the easyest ways in the code!
 */
(function($){
var counter = 0;
jQuery.fn.smartable = function(options) {
	/* Eléments de style définis:
	 * colresizing, highlight et kiki
	 */
	var op = jQuery.extend({
		prefix:             'st', /// pas encore utilisé partout
		rowhighlight:       false,
		rowhighlightclass:  'highlight',
		addrowselector:     false,
		setrowselector:     false,
		rowselectedclass:   'rowselected',
		colresizable:       false,
		colresizingclass:   'colresizing',
		colresizablehandle: false,
		tblresizable:       false,
		theadfixedonpage:   false
		/// clss css pour la bordure du bas du HeaderClone. 'none' par défaut
	}, options); 

	this.each(function(){

		counter++;
		//writeInConsole( 'START '+ counter );

		var $tbl     = $(this);
		var $thead   = $("thead",$tbl);
		var hasTHead = ( $thead.get(0) ? true : false );
		var $thead_tr;
		var $tbody_tr;
		if ( hasTHead ) {
			$thead_tr = $("tr",$thead);
			$tbody_tr = $("tbody tr",$tbl);
		} else {
			$thead_tr = $tbl.find("tr:lt(1)");
			$tbody_tr = $tbl.find("tr:gt(0)");
			$thead    = $thead_tr;
		}
		//writeInConsole( $thead.html() );



		/*************************************************************/
		// Highlight
		/*************************************************************/
		if (op.rowhighlight) { // mais le header n'existe peut-être pas du tout: c'est que des données
			                   // donc pour highlight toutes les lignes sont vues comme tbody
							   // c'est le css si on a th qui exclu le highlight de la première ligne
							   // et si le thead est en place, tout va bien
			set_rowhighlight( true );
		}
		function set_rowhighlight( ok ) {
			if( ok ) {
				$('tbody tr',$tbl).on('mouseenter', rowhighlight_on);
				$('tbody tr',$tbl).on('mouseleave', rowhighlight_off);
			} else {
				$('tbody tr',$tbl).off('mouseenter', rowhighlight_on);
				$('tbody tr',$tbl).off('mouseleave', rowhighlight_off);
			}
		}
		function rowhighlight_on() {
				$(this).addClass(op.rowhighlightclass);
		}
		function rowhighlight_off() {
				$(this).removeClass(op.rowhighlightclass);
		}


		/*************************************************************/
		// Ajout du selecteur de ligne
		/*************************************************************/
		if (op.addrowselector) {
			$('tr', $tbl).prepend('<th/>');
			op.setrowselector = true; /// il faut prendre la valeur par défaut
		}


		/*************************************************************/
		// Fonctionnalités du selecteur de ligne
		/*************************************************************/
		if (op.setrowselector) {
			var $Selects  = $('*:first',$tbody_tr);
			var $Sel_start;
			var Sel_Y;
			var hi;
			$Selects.on('mousedown', function(event) {
				$Sel_start = $(this);
				Sel_Y      = event.pageY;

				// On désactive rowhighlight pendant le sélection
				hi = op.rowhighlight; // on mémorise la position
				set_rowhighlight( false );
				$('tbody tr',$tbl).removeClass(op.rowhighlightclass);

				//writeInConsole('mousedown '+ Sel_Y+' '+ $Sel_start.offset().top +' '+ ($Sel_start===$(this)) );
				$(document).on('mousemove',{th:$Sel_start}, sel_mousemove);
				$(document).on('mouseup', sel_mouseup);
			});
			$Selects.on('click', function(event) {
				$tr = $(this).parent();
				isSelected = $tr.hasClass(op.rowselectedclass);
				//writeInConsole( 'click '+ isSelected );
				if ( !event.ctrlKey ) unselectAll( $tbody_tr );
				if ( isSelected ) unselectTr( $tr ); else selectTr( $tr );
			});
			function sel_mousemove( event ){
				//writeInConsole('mousemove '+ event.pageY +' '+ event.data.th.offset().top +' '+ ($Sel_start===$(this)) );
				$Selects.each(function(indice,element){
					//writeInConsole( indice +' '+ Sel_Y +' '+ $(element).offset().top +' '+ event.pageY );
					if ( event.data.th.offset().top <= $(element).offset().top
					  && $(element).offset().top    <= event.pageY                ) selectTr( $(element).parent() );
					else unselectTr( $(element).parent() );
				});
			}
			function sel_mouseup( event ){
				//writeInConsole('mouseup');
				set_rowhighlight( true );
				op.rowhighlight = hi;
				$(document).off('mousemove', sel_mousemove);
				$(document).off('mouseup',   sel_mouseup  );
			}
			function unselectAll( $tbody_tr ){
				//writeInConsole('unselectAll');
				$tbody_tr.removeClass(op.rowselectedclass);
			}
			function selectTr( $tr ){
				$tr.addClass(op.rowselectedclass);
			}
			function unselectTr( $tr ){
				$tr.removeClass(op.rowselectedclass);
			}
		}


		/*************************************************************/
		// Colonnes resizable
		/*************************************************************/
		if (op.colresizable) {
			if (op.addrowselector) {
				// 'Row selectors' are not resizable
				$thead_th = $('th:not(:first-child),td:not(:first-child)', $thead);
			} else {
				$thead_th = $('th,td', $thead);
			}
			if (op.colresizablehandle) {
				// If we choosed the 'column resizable handle'
				$thead_th.prepend('<div class="kiki">|</div>');/// renommer kiki et bien le gérer (avec le préfixe ?)
			}
			var start;
			var startX;
			var startWidth;

			$thead_th.on('mousedown', function(event) {
				writeInConsole( 'mousedown ' );
				start      = $(this);
				startX     = event.pageX;
				startWidth = $(this).width();
				$(start).addClass(op.colresizingclass);
				$(document).on('mousemove', colresiz_mousemove);
				$(document).on('mouseup', colresiz_mouseup);
			});
			function colresiz_mousemove( event ){
				writeInConsole( 'colresiz_mousemove '+ $(start).parents('table:first').attr('id') );
				if (op.headfixedonpage) {
					$('#'+$(start).data('brotherself')).width(startWidth+(event.pageX-startX));
					if (op.headfixedonpage) $('#'+$(start).data('brother')).width(startWidth+(event.pageX-startX));
				} else {
					$(start).width(startWidth+(event.pageX-startX));
				}
			}
			function colresiz_mouseup( event ){
				writeInConsole( 'colresiz_mouseup ' );
				$(document).off('mousemove', colresiz_mousemove);
				$(document).off('mouseup',   colresiz_mouseup  );
				$(start).removeClass(op.colresizingclass);
			}
		}


		/*************************************************************/
		// Header fixé en haut de page
		/*************************************************************/
		if (op.headfixedonpage) {
			if((typeof $tbl.attr('id'))=='undefined')$tbl.attr('id', op.prefix+'-'+ counter +'-tbl');
			var $clonedTable = $tbl.clone(true,true).empty();
			var $clonedTHead = $thead.clone(true,true);
			// Manipulations sur la table
			$clonedTable.css('border-bottom','none');
			$clonedTable.css('background-color','#FFFFCC'); // just for dev (jaune)
			$clonedTable.find("*").andSelf().each(function(index, element) {
				if(element.id) element.id = element.id +'-clone'; // tous les id existants sont renommés dans le clone
			});
			// Manipulations sur les thead
			/// si il y a plusieurs tr, le brother doit toujours référer au premier tr
			/// si il y a déjà un id, on n'en crée pas un nouveau
			// mais en fait, le business des brother on devrait le faire par les indexes
			$('tr',$thead).each(function(indexTr, elementTr) {
				$('th,td', $(elementTr)).each(function(index, element) {
					strId = op.prefix+'-'+ counter +'-tr'+ indexTr +'-hc'+ index;
					$(element).attr('id', strId);
					$(element).data('brother', op.prefix+'-'+ counter +'-tr0-hc'+ index +'-clone' );
					$(element).data('brotherself', op.prefix+'-'+ counter +'-tr0-hc'+ index );
				});
			});
			$('tr',$clonedTHead).each(function(indexTr, elementTr) {
				$('th,td', $(elementTr)).each(function(index, element) {
					strId = op.prefix+'-'+ counter +'-tr'+ indexTr +'-hc'+ index;
					$(element).attr('id', strId +'-clone' );
					$(element).data('brother', op.prefix+'-'+ counter +'-tr0-hc'+ index );
					$(element).data('brotherself', op.prefix+'-'+ counter +'-tr0-hc'+ index +'-clone' );
				});
			});
			// Incertion dans la DOM
			$clonedTable.append( $clonedTHead ).hide().appendTo($("body") );

            $(window).scroll(function () {
				var TableOffsetLeft = $tbl.offset().left - $(window).scrollLeft() + parseInt($('body').css('border-left-width'));
				if (debug) plusDebug = 0;///
				if (jQuery.browser.msie && jQuery.browser.version == "6.0") $clonedTable.css({
                    "position": "absolute",
                    "margin-top": "0",
                    "margin-left": "0",
                    "padding-bottom": "0",
                    "top": $(window).scrollTop(),
                    "left": $tbl.offset().left +plusDebug
                });
                else $clonedTable.css({
                    "position": "fixed",
                    "margin-top": "0",
                    "margin-left": "0",
                    "padding-bottom": "0",
                    "top": "0",
                    "left": TableOffsetLeft +plusDebug
                });
				//$clonedTable.offset({ left: $tbl.offset().left });//bonne mesure mais clignote avant d'apparaître
                var WinScrollTop       = $(window).scrollTop();
                var TblTop             = $tbl.offset().top + parseInt($('body').css('border-top-width'));
                var tLastRowHeight     = $tbl.find("tr:last").height();
				var tBorderTopWidth    = parseInt($tbl.css('border-top-width'));
				var tBorderBottomWidth = parseInt($tbl.css('border-bottom-width'));
				var tBorderSpacing     = parseInt($tbl.css('border-spacing'));
				var tPaddingTop        = parseInt($tbl.css('padding-top'));
				var tPaddingBottom     = parseInt($tbl.css('padding-bottom'));
				var cBorderTopWidth    = parseInt($clonedTable.css('border-top-width'));
				var cBorderBottomWidth = parseInt($clonedTable.css('border-bottom-width'));
				var cBorderSpacing     = parseInt($clonedTable.css('border-spacing'));
				var cPaddingTop        = parseInt($clonedTable.css('padding-top'));
				RealTableHeight = $tbl.height() + tBorderTopWidth + tBorderBottomWidth + tPaddingTop + tPaddingBottom;
				RealCloneHeight = $clonedTable.height() + cBorderTopWidth + cBorderBottomWidth + cPaddingTop;
				BottomVisible   = tBorderBottomWidth + tBorderSpacing + tPaddingBottom + tLastRowHeight; 
				var CloneZone   = TblTop + RealTableHeight - RealCloneHeight - BottomVisible;

				$("div#RealCloneHeight").css({'border':'none','border-left':'2px solid red', 'position':'fixed', 'top':'0px', 'left':'253px', 'width':'0px', 'height':RealCloneHeight, 'display':'block','z-index':'100'});
				$("div#RealTableHeight").css({'border':'none','border-left':'2px solid red', 'position':'fixed', 'top':TblTop , 'left':'270px', 'width':'0px', 'height':RealTableHeight, 'display':'block','z-index':'100'});
				fTop = ( TblTop + RealTableHeight - WinScrollTop );// - WinScrollTop + BottomVisible;
				$("div#BottomVisible").css({'border':'none','border-left':'2px solid red', 'position':'fixed', 'top':fTop-BottomVisible , 'left':'257px', 'width':'0px', 'height':BottomVisible, 'display':'block','z-index':'100'});
				$("div#WinScrollTop").css({'border':'none','border-left':'2px solid red', 'position':'fixed', 'top':'0px', 'left':'276px', 'width':'0px', 'height':WinScrollTop, 'display':'block','z-index':'100'});

				if (WinScrollTop > TblTop ) {

					if ( WinScrollTop <= ( CloneZone )) {
						$clonedTable.css('background-color','#FFFFCC'); // just for dev (jaune)
						$clonedTable.show(); place='jaune';

					} else if( WinScrollTop <= CloneZone + RealCloneHeight ) {
						$clonedTable.css('background-color','#CCFFFF'); // just for dev (bleu)
						$tbl.css('background-color','transparent'); // just for dev (rose)
						$clonedTable.css( 'top', ( CloneZone - WinScrollTop ) );
						$clonedTable.show(); place='bleu';

					} else {
						$tbl.css('background-color','#FFCCFF'); // just for dev (rose)
						$clonedTable.hide(); place='sortie bas';
					}
                } else {
					$tbl.css('background-color','transparent'); // just for dev (retour normal)
					$clonedTable.hide(); place='au-dessus';
				}
				//writeInConsole("scroll: "+ WinScrollTop +" "+ ( tBorderBottomWidth - cBorderSpacing ) +" "+ place);
            });
			function get_cHeaderHeight(){
				var cBorderTopWidth    = parseInt($TheClone.css('border-top-width'));
				var cBorderBottomWidth = parseInt($TheClone.css('border-bottom-width'));
				var cBorderSpacing     = parseInt($TheClone.css('border-spacing'));
				var cPaddingTop        = parseInt($TheClone.css('padding-top'));
				return $TheClone.height() + cBorderTopWidth + cBorderBottomWidth + cPaddingTop;
			}
			function get_tHeaderHeight(){
				$trs = $thead.find("tr");
				nbr  = $trs.size();
				sum  = 0;
				$trs.each(function(){  sum += $(this).height();  });
				sum += parseInt($tbl.css('border-top-width'));
				sum += parseInt($tbl.css('padding-top'));
				sum += (nbr+1) * parseInt($tbl.css('border-spacing'));
				//writeInConsole( nbr +' '+ sum );
				return sum;
			}
            $(window).resize(function () {
				var TableOffsetLeft = $tbl.offset().left - $(window).scrollLeft() + parseInt($('body').css('border-left-width'));
                if ($clonedTable.outerWidth() != $tbl.outerWidth()) {
                    $thead.find('th').each(function (index) {
                        var w = $(this).width();
                        $(this).css("width", w);
                        $clonedTable.find('th').eq(index).css("width", w);
                    });
                    $clonedTable.width($tbl.outerWidth());
                }
                $clonedTable.css("left", TableOffsetLeft);
            });
		}
		// Réinitialise les positions en cas de reload de la page
		$(window).scroll();
		//$(window).resize(); /// je crois bien que celui-là est inutile


		/*************************************************************/
		// Table resizable
		/*************************************************************/
		if(op.tblresizable) {
			if (op.headfixedonpage) {
				$TheClone = $('#'+$tbl.attr('id')+'-clone'); /// il faudra faire sans le id
				$tbl.resizable({
					autoHide: true,
					resize: function(event, ui) {
						if (op.headfixedonpage) {
							//$TheClone.width(  $(this).outerWidth() ); /// le width est fait ailleurs, je ne sais plus où
							$TheClone.height( get_tHeaderHeight()  );
						}
					}
				});
			} else {
				$tbl.resizable({
					autoHide: true,
				});
			}
		}

	//writeInConsole( 'OK '+ counter );
	});
};
})(jQuery);