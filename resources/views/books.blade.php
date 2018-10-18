<table class="table">
    <thead>
    <tr>
        <th scope="col">Фото</th>
        <th scope="col">Название</th>
        <th scope="col">Автор</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($books as $book)
        <tr>
            <td><img src="{{ $book->image }}" class="rounded float-left" style="max-width:auto; max-height: 10%;"></td>
            <td>{{ $book->name }}</td>
            @foreach($authors as $author)
                @if($author->id == $book->author_id)
                    <td>{{ $author->name }}</td>
                @endif
            @endforeach
            <td style="border-style: none">
                <button type="button" class="btn btn-primary open-modal" data-url="{{ url('send/'.$book->id) }}">
                    Оформить заявку
                </button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" role="dialog">
    <div class="modal-dialog">
        <form method="post" action="{{ url('send/'.$book->id) }}" id="mailForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Оформить заявку на книгу</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Ваше имя:</label>
                        <input type="text" name="name" class="form-control" id="recipient-name" required>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary" id="btn-submit">Отправить</button>
                </div>
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->

<script>

    $(document).ready(function(){
        $('.open-modal').click(function(e){
            var btn = $(this);
            $.ajax({
                type: 'get',
                url: btn.attr("data-url"),
                dataType: 'json',
                beforeSend: function () {
                    $("#exampleModal").modal("show");
                    $("#exampleModal").find("form").attr('action',this.url);
                }
            });
        });
    });



    $(document).ready(function(){
        $('#mailForm').on('submit', function(e){
            var form = $(this);
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: form.attr("action"),
                data: $('#mailForm').serialize(),

                success: function(data){
                    if($.isEmptyObject(data.errors)){
                        $("#exampleModal").modal("hide");
                        alert("Ваша заявка успешно отправлена.");
                    }else{
                        printErrorMsg(data.errors);
                    }

                }
            });
        });
    });

    function printErrorMsg (msg) {
        $(".print-error-msg").css('display','block');
        $(".print-error-msg").find("ul").empty();
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
        });
    }


</script>

{!! $books->render() !!}
