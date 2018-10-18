<table class="table ">
    <thead>
        <tr>
            <th>Фото</th>
            <th>Название</th>
            <th>Книги</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($authors as $author)
            <tr>
                <td><img src="{{ $author->image }}" class="rounded float-left" style="max-width:50%; height: auto;"></td>
                <td>{{ $author->name }}</td>
                <td>
                    <ul>
                        @foreach($books as $book)
                            @if($author->id == $book->author_id)
                                <li>
                                    {{ $book->name }}
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>

<script !src="">


</script>

{!! $authors->render() !!}

