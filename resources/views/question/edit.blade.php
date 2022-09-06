
                <form action= {{ route("question.update", $question)}} method="POST">

                    @csrf

                    @method('PUT')

                    <input class='' value={{ $question->title}} type='text' name='title'>

                    <textarea class='' type='text' name='content'>{{ $question->content}}</textarea>

                    <input type='submit' value='update'>

                </form>
