// delete button
$('.deleteBtn').on('click', function(e) {
    e.preventDefault();

    const linkDel = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure to delete it?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = linkDel;
        }
      })
});
