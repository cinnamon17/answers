
<form action= {{route('question.store')}} method='POST'>

    @csrf
    @method('POST')

    <input type="text" name="title">

    <textarea type="text" name="content"></textarea>

    <input type="submit" value="save">

    </form>
