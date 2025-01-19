<?php

require_once 'includes/header.php';
require_once '../class/Crud.php';
$obj = new Crud();

$q = $obj->custom_get("category");


$no_of_records_per_page = 5;

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$offset = ($pageno - 1) * $no_of_records_per_page;

?>
<div class="container">
    <section class="category-section">
        <h1 class="text-uppercase border-bottom">All Products</h1>

        <button class="btn btn-primary add_product">Add new Product +</button>
        <!-- product form start here -->
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="product_form">
                            <div class="row">
                                <!-- product title -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="prodcuct_title">Product Title</label>
                                        <input type="text" class="form-control" name="product_title" id="prodcuct_title" placeholder="Product Title">
                                        <span id="productError" class="text-danger"></span>
                                    </div>

                                </div>

                                <!-- select a prodcuct category -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <select name="category_name" id="category_name" class="form-control">
                                            <option value="0">Select a Category</option>
                                            <?php foreach ($q as $row) : ?>
                                                <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                        <span id="categoryError" class="text-danger"></span>
                                    </div>
                                </div>

                                <!-- select a prodcuct brand -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="brand_name">Brand Name</label>
                                        <select name="brand_name" id="brand_name" class="form-control">
                                            <option value="0" disabled>Select a Category first </option>
                                        </select>
                                    </div>

                                    <span id="BrandError" class="text-danger"></span>
                                </div>

                                <!-- regular price -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="regular_price">Regular Price</label>
                                        <input type="text" class="form-control" name="regular_price" id="regular_price" placeholder="Regular Price">
                                        <span id="regularPriceError" class="text-danger"></span>
                                    </div>

                                </div>

                                <!-- Selling price -->
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="selling_price">Selling Price</label>
                                        <input type="text" class="form-control" name="selling_price" id="selling_price" placeholder="Selling Price">
                                        <span id="sellingPriceError" class="text-danger"></span>
                                    </div>

                                </div>

                                <!-- thumbnail -->

                                <div class="col-md-12 mb-3 toggle_product_thumbnail">
                                    <h5>Product Thumbnail</h5>
                                    <img src="" id="fetched_product_thumbnail" height="200px">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="product_thumbnail">Upload Product Thumbnail</label>
                                        <input type="file" class="form-control" name="product_thumbnail" id="product_thumbnail">
                                        <span id="thumbnail_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <!-- Short Description -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea name="short_description" id="short_description" rows="5" class="form-control" placeholder="Short Description"></textarea>
                                        <span id="short_description_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <!-- Long/breif Description -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="long_description">Long Description</label>
                                        <textarea name="long_description" id="long_description" rows="5" class="form-control" placeholder="Long Description"></textarea>
                                        <span id="long_description_error" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>Add More Thumbnails</label>
                                </div>
                                <div class="col-md-10 mb-3">
                                    <input type="file" class="form-control">
                                </div>

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-success btn-block add-more-thumbnail">Add</button>
                                </div>
                            </div>

                            <span class="extra-thumbnail-area"></span>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="product_id" name="product_id">
                        <input type="hidden" name="form_type" id="form_type">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary save" id="submit">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- product form end -->


        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <th>Thumbnail</th>
                <th>Product Name</th>
                <th>Category Name</th>
                <th>Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php foreach ($obj->get('products LEFT JOIN category ON products.category_id = category.category_id LEFT JOIN brand ON products.brand_id = brand.brand_id ORDER BY products.product_id DESC', $offset, $no_of_records_per_page) as $row) { ?>
                <tr class="product_row_<?= $row['product_id']; ?>">
                    <td><?= $row['product_id']; ?></td>
                    <td><img height="70px" src="../uploads/products/<?= $row['product_thumbnail']; ?>"></td>
                    <td>
                        <p class="prodcut_title mb-0 font-weight-bold"><?= $row['product_title']; ?></p>
                        <small class="text-success"><?= $row['brand_name']; ?></small>
                    </td>
                    <td><?= $row['category_name']; ?></td>
                    <td><?= $row['brand_created_at']; ?></td>
                    <td><button class="btn btn-primary edit-product" id="<?= $row['product_id']; ?>">Edit</button></td>
                    <td><button class="btn btn-danger delete-product" data-product-id="<?= $row['product_id']; ?>">Delete</button></td>
                </tr>
            <?php } ?>

        </table>

        <ul class="pagination">
            <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
            <li class="page-item <?php if ($pageno <= 1) {
                                        echo 'disabled';
                                    } ?>">
                <a href="<?php if ($pageno <= 1) {
                                echo '#';
                            } else {
                                echo '?pageno=' . ($pageno - 1);
                            } ?>" class="page-link"><span class="larger-angle">&lt;&lt;</span> Previos</a>
            </li>
            <?php
            $total_pages = $obj->pagination('products', $no_of_records_per_page);
            for ($i = 1; $i <= $total_pages; $i++) {

                if ($pageno == $i) {
                    echo '<li class="page-item active"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>';
                } else {
                    echo '<li class="page-item"><a href="?pageno=' . $i . '" class="page-link">' . $i . '</a></li>';
                }
            }
            ?>
            <li class="page-item <?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?>">
                <a href="<?php if ($pageno >= $total_pages) {
                                echo '#';
                            } else {
                                echo '?pageno=' . ($pageno + 1);
                            } ?>" class="page-link">Next <span class="larger-angle">&gt;&gt;</span></a>
            </li>
            <li class="page-item <?php if ($pageno >= $total_pages) {
                                        echo 'disabled';
                                    } ?>"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>
    </section>
</div>


<?php require_once 'includes/footer.php'; ?>
<script>
    $(document).ready(function() {
        $(".toggle_product_thumbnail").hide();

        $("#category_name").change(function() {
            var cat_id = $("#category_name").val();
            fetch_brand(cat_id);
        });

        $(".delete-product").click(function() {
            let product_id = $(this).data("product-id");
            let delete_confirmation = confirm("Are you sure you want to delete this product ?");
            if (delete_confirmation) {
                $.ajax({
                    url: "action/product_action.php",
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        form_type: "delete_product"
                    },
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 200) {
                            $(".product_row_" + product_id).remove();
                        }
                    }
                })
            }
        });

        function fetch_brand(cat_id) {
            $.ajax({
                url: "action/cat_action.php",
                type: "POST",
                data: {
                    cat_id: cat_id,
                    action: 'fetch_brand'
                },
                success: function(response) {
                    $("#brand_name").html(response);
                }
            })
        }
        $('#product_form').on('submit', function(event) {

            event.preventDefault();

            const thumb_previwe = $('#fetched_product_thumbnail').attr('src');

            // start validation rules for product form
            var product_title = $('#prodcuct_title').val();
            var category_name = $('#category_name').val();
            var brand_name = $('#brand_name').val();
            var regular_price = $('#regular_price').val();
            var selling_price = $('#selling_price').val();
            var product_thumbnail = $('#product_thumbnail').val();
            var short_description = $('#short_description').val();
            var long_description = $('#long_description').val();

            // apply the validation for product Name
            if (product_title == '' || product_title == null) {
                $('#productError').text("product Name is required.");
                return;
            } else {
                $('#productError').text("");
            }

            // apply the validation for category Name
            if (category_name == '' || category_name == null) {
                $('#categoryError').html("Please Select a Category Name.");
                return;
            } else {
                $('#categoryError').html("");
            }

            if (brand_name == '' || brand_name == null) {
                $('#BrandError').text("Please Select a Brand Name.");
                return;
            } else {
                $('#BrandError').text("");
            }

            if (regular_price == '' || regular_price == null) {
                $('#regularPriceError').text("Regular Price field is required.");
                return;
            } else {
                $('#regularPriceError').text("");
            }

            if (selling_price == '' || selling_price == null) {
                $('#sellingPriceError').text("Selling Price field is required.");
                return;
            } else {
                $('#sellingPriceError').text("");
            }
            if (thumb_previwe == '' || thumb_previwe == null) {
                if (product_thumbnail == '' || product_thumbnail == null) {
                    $('#thumbnail_error').text("Product Thumbnail field is required.");
                    return;
                } else {
                    $('#thumbnail_error').text("");
                }
            }

            if (short_description == '' || short_description == null) {
                $('#short_description_error').text("Short Description field is required.");
                return;
            } else {
                $('#short_description_error').text("");
            }

            if (long_description == '' || long_description == null) {
                $('#long_description_error').text("Long Description field is required.");
                return;
            } else {
                $('#long_description_error').text("");
            }


            var form_data = new FormData(this);

            $.ajax({
                url: "action/product_action.php",
                method: 'POST',
                data: form_data,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == 'error') {
                        $('#thumbnail_error').text(response.message);
                        return;
                    }
                    if (response.status == 1) {
                        $('#product_form')[0].reset();
                        $('#productModal').modal('hide');
                        location.reload();
                    }
                }
            })
        })
        $('.edit-product').click(function() {
            $("#productModal").modal('show');
            $('.modal-title').text("Update Product");
            $('#form_type').val('update_product');
            $(".toggle_product_thumbnail").show();
            $('#submit').text("Update")

            let id = $(this).attr('id');
            let form_type = 'fetch_product';

            let fd = new FormData();
            fd.append('product_id', id);
            fd.append('form_type', form_type);

            $.ajax({
                url: "action/product_action.php",
                type: 'POST',
                data: fd,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(res) {
                    // console.log(res);
                    var product_title = $('#prodcuct_title').val(res.product_title);
                    var category_name = $('#category_name').val(res.category_id);

                    if (res.category_id) {
                        fetch_brand(res.category_id);
                    }
                    setTimeout(() => {
                        var brand_name = $('#brand_name').val(res.brand_id);
                    }, 400);

                    var regular_price = $('#regular_price').val(res.regular_price);
                    var selling_price = $('#selling_price').val(res.selling_price);
                    var short_description = $('#short_description').val(res.short_description);
                    var long_description = $('#long_description').val(res.long_description);

                    $('#fetched_product_thumbnail').attr('src', '../uploads/products/' + res.product_thumbnail);
                    $('#product_id').val(res.product_id);
                }
            })
        })
    });
</script>