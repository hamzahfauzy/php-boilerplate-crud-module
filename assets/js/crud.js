$('.datatable-crud').dataTable({
    // stateSave:true,
    pagingType: 'full_numbers_no_ellipses',
    processing: true,
    search: {
        return: true
    },
    serverSide: true,
    ajax: location.href,
    aLengthMenu: [
        [25, 50, 100, 200],
        [25, 50, 100, 200]
    ],
})

try {
    $('select').select2()
} catch (error) {
    
}