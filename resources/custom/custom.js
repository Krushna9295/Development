$( document ).ready(function() {
    $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
// $('#district').on('change',function(){
//     var dis_id = $('#district').val();
//     console.log(base_url);
//     $.ajax({
//             url: base_url+"/cluster/tahsilData",
//             type:'POST',
//             data: {dis_id:dis_id},
//             dataType: 'text',
//             headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
//             success: function(data) {
//                alert(data);
//                 var a = JSON.parse(data);
//                 var row = "";
//                 for(var i=0; i<a.length;i++){
//                    row += "<option value='"+a[i].thl_code+"'>"+a[i].thl_name+"</option>";
//                 }
//                 $('#tahsil').append(row);
//             }
//     });
// });
