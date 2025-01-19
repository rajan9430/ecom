$(document).ready(function () {
    // When the document is fully loaded, execute the following code

    // When the element with class 'menu-btn' is clicked
    $('.menu-btn').click(function () {
        // Set CSS properties of the element with class 'sidebar'
        $('.sidebar').css({
            'width': '70px', // Set the width to 70px
            'font-size': '30px', // Set the font size to 30px
        });
        // Hide all elements with class 'text-link'
        $('.text-link').hide();
        // Show all elements with class 'close-btn'
        $('.close-btn').show();
        // Hide the clicked 'menu-btn' element
        $('.menu-btn').hide();
    });

    // When the element with class 'close-btn' is clicked
    $('.close-btn').click(function () {
        // Set CSS properties of the element with class 'sidebar'
        $('.sidebar').css({
            'width': '200px', // Set the width to 200px
            'font-size': '16px' // Set the font size to 16px
        });
        // Show all elements with class 'text-link'
        $('.text-link').show();
        // Hide all elements with class 'close-btn'
        $('.close-btn').hide();
        // Show all elements with class 'menu-btn'
        $('.menu-btn').show();
    });

    // When the element with class 'add-category-btn' is clicked
    $('.add-category-btn').click(function () {
        // Display an alert with the message 'worked'
        alert('worked');
    });

    // When the element with class 'add_category' is clicked
    $('.add_category').click(function () {
        // Show the modal with id 'catModal'
        $('#catModal').modal('show');
        // Set the text of the element with class 'modal-title' to 'Add a New Category'
        $('.modal-title').text('Add a New Category');
        // Set the value of the element with id 'form_type' to 'save'
        $('#form_type').val('save');
    });

    // When the element with class 'add_brand' is clicked
    $('.add_brand').click(function () {
        // Show the modal with id 'brandModal'
        $('#brandModal').modal('show');
        // Set the text of the element with class 'modal-title' to 'Add a New Brand'
        $('.modal-title').text('Add a New Brand');
        // Set the value of the element with id 'form_type' to 'save'
        $('#form_type').val('save');
    });

    // When the element with class 'add_product' is clicked
    $('.add_product').click(function () {
        // Set the text of the element with id 'submit' to 'Save'
        $('#submit').text("Save");
        // Reset the form with id 'product_form'
        $('#product_form')[0].reset();
        // Show the modal with id 'productModal'
        $('#productModal').modal('show');
        // Set the text of the element with class 'modal-title' to 'Add a New Product'
        $('.modal-title').text('Add a New Product');
        // Set the value of the element with id 'form_type' to 'save'
        $('#form_type').val('save');
        // Hide the elements with class 'toggle_product_thumbnail'
        $(".toggle_product_thumbnail").hide();
        // Set the 'src' attribute of the element with id 'fetched_product_thumbnail' to null
        $('#fetched_product_thumbnail').attr('src', null);
    });

    $('.add_slider').click(function () {
        // Show the modal with id 'catModal'
        $('#sliderModal').modal('show');
        // Set the text of the element with class 'modal-title' to 'Add a New Category'
        $('.modal-title').text('Add a New Slider');
        $('#submit').removeClass('btn-warning update').addClass('btn-primary save').text('Save');
        $('#slider_old_image').attr('src',``)
        // Set the value of the element with id 'form_type' to 'save'
        $('#form_type').val('save');
    });

    // Initialize a variable 'count' to 0
    var count = 0;
    // When the element with class 'add-more-thumbnail' is clicked
    $(".add-more-thumbnail").click(function () {
        // Increment the count by 1
        count = count + 1;
        // Create HTML structure for a new row with file input and remove button
        var html = '<div class="row" id="row-' + count + '">';
        html += '<div class="col-md-12">';
        html += '    <label>Add More Thumbnails</label>';
        html += '</div>';
        html += '<div class="col-md-10">';
        html += '    <input type="file" class="form-control">';
        html += '</div>';
        html += '<div class="col-md-2">';
        html += '    <button type="button" id="' + count + '" class="btn btn-danger btn-block remove">Remove</button>';
        html += '</div>';
        html += '</div>';
        // Append the new HTML structure to the element with class 'extra-thumbnail-area'
        $(".extra-thumbnail-area").append(html);
    });

    // When any element with class 'remove' is clicked
    $(document).on('click', '.remove', function () {
        // Get the id attribute of the clicked 'remove' button
        var row_data = $(this).attr('id');
        // Remove the row with the corresponding id
        $("#row-" + row_data).remove();
    });
});
