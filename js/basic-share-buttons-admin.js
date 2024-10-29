jQuery(document).ready(function($) {

  /**
   * makes sites sortable and updates the input 
   * value after a sort
   */
  var shareButtons = $('#basic-share-buttons__sites')
  var cssTextarea = $(".basic-share-buttons__css textarea")
  var $sortSelected = $('.basic-share-buttons__selected')
  var $sortAvailable = $('.basic-share-buttons__available')

  function generateCSS() {
    if (!cssTextarea.length) return

    var sites = getSelectedSites()
    cssTextarea.empty()

     var css = window.BSBCSS.base
     $.each(sites, function() {
       var site = this.toLowerCase()
       if (window.BSBCSS.sites[site] != undefined) {
         css = css + "\n\n" + window.BSBCSS.sites[site]
       }
     })

     cssTextarea.val(css)
  }

  function getSelectedSites() {
    var selected = []
    $sortSelected.children().each(function() {
      selected.push($(this).attr("data-bsb"))
    })

    return selected
  }

  function bsbSortable() {
    if (!shareButtons.length || !$sortSelected.length || !$sortAvailable.length) return

    var sites = shareButtons.val().split(" ")
    $.each(sites, function() {
      $sortAvailable.find("[data-bsb='"+this+"']").appendTo($sortSelected)
      
    })

    function onEnd() {
      // fires after a sort/move
      generateCSS()
      var sites = getSelectedSites()
      shareButtons.val(sites.join(" "))
    }

    var opts = {
      onEnd: onEnd,
      group: 'basic-share-buttons',
      animation: 150,
    }

    Sortable.create($sortSelected.get(0), opts)
    Sortable.create($sortAvailable.get(0), opts)
  }

  bsbSortable()

  function bsbSizeChange() {
    var $radios = $('.basic-share-buttons__size-section input[type="radio"]')
    if (!$radios.length) return
    $radios.change(function(e) {
      $('.basic-share-button').removeClass("basic-share-button--large basic-share-button--medium basic-share-button--small").addClass("basic-share-button--" + $(this).val())
    })
  }

  bsbSizeChange()

  function bsbCSSChange() {
    var $radios = $('.basic-share-buttons__style-section input[type="radio"]')
    if (!$radios.length) return
    $radios.change(function(e) {
      if ($(this).val() == "yes") {
        $('.basic-share-buttons__css').hide()
      } else {
        generateCSS()
        $('.basic-share-buttons__css').show()
      }
    })
  }

  bsbCSSChange()

  generateCSS()

})
