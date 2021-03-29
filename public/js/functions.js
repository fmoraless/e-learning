jQuery(document).ready(function () {
   $('.delete-record').jConfirm().on('confirm', function(e) {
       const btn = $(this);
       const route = btn.data("route");
       jQuery.ajax({
           method: "DELETE",
           url: route,
           success: function (data) {
              window.location.reload();
          },
           error: function (error) {
              window.location.reload();
           }
       });
   });
});
