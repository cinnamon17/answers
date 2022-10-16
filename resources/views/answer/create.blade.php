

<form action= {{route('answer.store')}} method='POST'>

    @csrf
    @method('POST')

    <textarea type="text" name="content"></textarea>

    <input type="hidden" name="question_id" value="{{ request()->get('question')}}">

    <input type="submit" value="save">

    </form>
