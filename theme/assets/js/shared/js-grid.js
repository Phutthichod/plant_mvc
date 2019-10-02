(function($) {
    'use strict';
    $(function() {
  
      //basic config
      if ($("#js-grid").length) {
        $("#js-grid").jsGrid({
          height: "500px",
          width: "100%",
          filtering: true,
          editing: true,
          inserting: false,
          sorting: true,
          paging: true,
          autoload: true,
          pageSize: 15,
          pageButtonCount: 5,
          deleteConfirm: "Do you really want to delete the client?",
          fields: [
            {
              name: "Alleles",
              type: "text",
              width: 150
            },
            {
              name: "Chromosome",
              type: "number",
              width: 50
            },
            {
              name: "Number of position",
              type: "text",
              width: 200
            },
            {
              name: "Range of position",
              type: "text",
              width: 200
            },
            {
              type: "control"
            }
          ]
        });
      }
  
  
      //Static
      if ($("#js-grid-static").length) {
        $("#js-grid-static").jsGrid({
          height: "500px",
          width: "100%",
  
          sorting: true,
          paging: true,

          fields: [
            {
              name: "Alleles",
              type: "text",
              width: 150
            },
            {
              name: "Chromosome",
              type: "number",
              width: 50
            },
            {
              name: "Number of position",
              type: "text",
              width: 200
            },
            {
              name: "Range of position",
              type: "text",
              width: 200
            },
            {
              type: "control"
            }
          ]
        });
      }
  
      if ($("#sort").length) {
        $("#sort").on("click", function() {
          var field = $("#sortingField").val();
          $("#js-grid-sortable").jsGrid("sort", field);
        });
      }
  
    });
  })(jQuery);