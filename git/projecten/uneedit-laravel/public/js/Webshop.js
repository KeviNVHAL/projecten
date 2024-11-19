$(document).ready(function() { 
    let loading = false; 

    function debounce(func, delay) {
        let timeoutId;
        return function(...args) {
            if (timeoutId) {
                clearTimeout(timeoutId);
            }
            timeoutId = setTimeout(() => {
                func.apply(this, args); 
            }, delay);
        };
    }

    // Function to load more products via AJAX
    const loadMoreProducts = debounce(function () {
        if (loading) return; 
        loading = true; 

        let nextPage = $(this).data('page') || 2; 
        let url = 'webshop?page=' + nextPage; 

        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('.product').remove();
                $('.product-grid').append(data.products); 
                $('#load-more').data('page', nextPage + 1); 
                $('#previous').show(); 

                if (!data.hasMore) {
                    $('#load-more').hide(); 
                }

                loading = false;
            },
            error: function() {
                console.log('Error loading more products.'); 
                loading = false;
            }
        });
    });

    // Event listener for load more button click
    $(document).on('click', '#load-more', loadMoreProducts);

    // Function to load previous products via AJAX
    const loadPreviousProducts = debounce(function() {
        let currentPage = $('#load-more').data('page') - 1;
        let previousPage = currentPage - 1; 
        let url = 'webshop?page=' + previousPage; 

        if (previousPage > 0) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.product').remove();
                    $('.product-grid').html(data.products); 
                    $('#load-more').data('page', previousPage + 1); 

                    if (data.hasMore) {
                        $('#load-more').show(); 
                    } else {
                        $('#load-more').hide();
                    }

                    if (previousPage === 1) {
                        $('#previous').hide(); 
                    } else {
                        $('#previous').show(); 
                    }
                },
                error: function() {
                    console.log('Error loading previous products.'); 
                }
            });
        }
    }); 

    // Event listener for previous button click
    $(document).on('click', '#previous', loadPreviousProducts);
});
