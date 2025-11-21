<x-layouts.main>

    <div class = "d-flex flex-row">
        <div class = "d-flex flex-row">
            <div class = "card" style = "width: 25rem; height: 100%;">
                <div class = "card-header fw-bold">
                    <h1 class = "text-center">Conversations</h1>
                    <ul class = "list-group list-group-flush">
                        <li class = "d-flex flex-row list-group-item justify-content-between rounded rounded-4">
                            <div>
                                <h4> Messages with yadadyada </h4>
                                <p> You're so skibidi bro <p>
                            </div>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>

        <div class = "d-flex flex-row flex-fill">
            <div class = "container border rounded-3 width-1" style = "position: relative;">
                <div>
                    <h1> Username </h1>
                </div>

                <div class = "rounded rounded-3 text-end">

                </div>
                

                <div class = "d-flex flex-row border border-3" style = "position: absolute; bottom: 0;"> 
                    <div class = "d-flex flex-row justify-content-evenly">
                        <button type = "button" class = "btn btn-info" > button </button>
                        <button type = "button" class = "btn btn-info" > button </button>
                        <button type = "button" class = "btn btn-info" > button </button>
                    </div>

                    <form method = "POST" action = "{{route(message.send, ['sender_id' => $user->id, 'receiver_id' => $user_id])}}" class = "d-flex flex-row">
                        <input type ="text" class = "form-control" name = "body" placeholder = "Aa" style ="width: 100%;"/>
                        <button type = "button" class = "btn btn-primary"> Send </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
