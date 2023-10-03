$(document).ready(function() {
    function confirmDelete(form, url) {
      if (confirm('本当に削除しますか？')) {
        $.ajax({
          url: url,
          type: 'POST',
          data: form.serialize(),
          success: function(response) {
            // 削除成功時の処理
            form.closest('tr').remove();
            console.log(response);
          },
          error: function(xhr, status, error) {
            // エラー時の処理
            console.log(xhr.responseText);
          }
        });
      }
    };
  
    $('#search-form').on('submit', function(event) {
      event.preventDefault();
  
      var formData = $(this).serialize();
  
      $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: formData,
        success: function(response) {
          var productList = $('.products_list tbody');
          var products = $(response).find('#products-table tbody tr');
          productList.empty();
  
          var productListArray = [];
  
          products.each(function() {
            var company = $(this).find('td:nth-child(1)').text();
            var image = $(this).find('td:nth-child(2) img').attr('src');
            var name = $(this).find('td:nth-child(3) a').text();
            var price = $(this).find('td:nth-child(4)').text();
            var stock = $(this).find('td:nth-child(5)').text();
            var comment = $(this).find('td:nth-child(6)').text();
            var id = parseInt($(this).data('id'));
  
            var product = {
              company: company,
              image: image,
              name: name,
              price: price,
              stock: stock,
              comment: comment,
              id: id,
              url: 'products/' + id
            };
  
            productListArray.push(product);
          });
  
          console.log(productListArray);
          console.log(products);
  
          productListArray.forEach(function(product) {
            var url = 'products/' + product.id;
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var html = '<tr data-id="' + product.id + '">' +
              '<td>' + product.company + '</td>' +
              '<td><img src="' + product.image + '" alt="商品画像" style="max-width: 200px;"></td>' +
              '<td><a href="' + product.url + '">' + product.name + '</a></td>' +
              '<td>' + product.price + '</td>' +
              '<td>' + product.stock + '</td>' +
              '<td>' + product.comment + '</td>' +
              '<td>' +
              '<form action="' + url + '" method="POST" onsubmit="event.preventDefault(); confirmDelete(this);">' +
              '<input type="hidden" name="_token" value="' + csrfToken + '">' +
              '<input type="hidden" name="_method" value="DELETE">' +
              '<button type="submit" class="btn btn-danger delete-btn"  data-product-id="' + product.id + '">削除</button>' +
              '</form>' +
              '</td>' +
              '</tr>';
  
            productList.append(html);
          });
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
    });
    $('.products_list').on('submit', 'form', function(event) {
      event.preventDefault();
    
      var form = $(this);
      var url = form.attr('action');
  
      confirmDelete(form, url);
    });
  });