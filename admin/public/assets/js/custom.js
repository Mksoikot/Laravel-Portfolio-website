function getProjectData() {
    axios.get('admin/projectData')

    .then(function(response) {

        if (response.status == 200) {

            $('#mainDivProject').removeClass('d-none');
            $('#loaderDivProject').addClass('d-none');

            var jsonData = response.data;

            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<td><img class='table-img' src=" +
                    jsonData[i].project_img + "></td>" +
                    "<td>" +
                    jsonData[i].project_name + "</td>" +
                    "<td>" +
                    jsonData[i].project_des + "</td>" +
                    "<td><a class='projectEditbtn' data-id=" +
                    jsonData[i].id +
                    " ><i class='fas fa-edit'></i></a> </td>" +
                    "<td><a  class='projectDeletebtn' data-id=" +
                    jsonData[i].id +
                    "  ><i class='fas fa-trash-alt'></i></a> </td>"
                ).appendTo('#project_table');
            })

            $('.projectDeletebtn').click(function() {
                var id = $(this).data('id');
                $('#projectdeleteId').attr('data-id', id);
                $('#deleteModalProject').modal('show');
            })

            $('#projectdeleteId').click(function() {
                var id = $(this).data('id');
                getProjectDelete(id);
            })

        } else {
            $('#loaderDivProject').addClass('d-none');
            $('#wrongDivProject').removeClass('d-none');
        }
    })

    .catch(function(error) {
        $('#loaderDivProject').addClass('d-none');
        $('#wrongDivProject').removeClass('d-none');
    });
}


function getProjectDelete(deleteID) {
    axios.post('admin/projectDelete', {
            id: deleteID
        })
        .then(function(response) {
            if (response.data == 1) {
                alert('Success');
                window.location.reload();
            } else {
                alert('Fail');

            }
        })
        .catch(function(error) {

        });
}
