# minesweeper_API
<h1>Minesweeper API Documentation</h1>

<h2>Create a Board</h2>
<p>
To create a new Board you have to send 4 parameters:
<ul>
    <li>plarerId (Integer - required)</li>
    <li>name (string - required)</li>
    <li>size (Integer - required)</li>
    <li>num-bombs (integer - required)</li>
</p>
<p>
The response will contain the created Board.
<h3>
POST /api/boards
</h3>
<h4>Example</h4>
<p>Request</p>
<pre>
POST /api/boards
{
    "playerId":2,
    "name":"New test",
    "size":4,
    "num-bombs": 4
}
</pre>
<p>Response</p>
<pre>
{
    "game": {
        "name": "New test",
        "user_id": "1",
        "size": "4",
        "grid_id": 24,
        "completed_at": null,
        "updated_at": "2020-08-25T23:39:37.000000Z",
        "created_at": "2020-08-25T23:39:37.000000Z",
        "id": 23
    }
}
</pre>
<h2>List Games</h2>
<h3>GET /api/games</h3>

<h4>Example</h4>
<p>Request</p>
<pre>
GET /api/games
</pre>
<p>Response</p>
<pre>
[
    {
        "id": 1,
        "name": "testing 10",
        "size": 3,
        "completed_at": "2020-08-13 22:17:41",
        "created_at": "2020-08-14T01:17:41.000000Z",
        "updated_at": "2020-08-14T01:17:41.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 1,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    },
    {
        "id": 2,
        "name": "prueba 12",
        "size": 6,
        "completed_at": "2020-08-18 11:26:54",
        "created_at": "2020-08-18T14:26:54.000000Z",
        "updated_at": "2020-08-18T14:26:54.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 2,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    },
    {
        "id": 3,
        "name": "test 200",
        "size": 8,
        "completed_at": "2020-08-18 11:29:59",
        "created_at": "2020-08-18T14:29:59.000000Z",
        "updated_at": "2020-08-18T14:29:59.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 3,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    },
    {
        "id": 4,
        "name": "y eia?",
        "size": 6,
        "completed_at": "2020-08-22 13:00:37",
        "created_at": "2020-08-22T16:00:37.000000Z",
        "updated_at": "2020-08-22T16:00:37.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 4,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    },
    {
        "id": 5,
        "name": "test 205",
        "size": 6,
        "completed_at": "2020-08-24 19:30:55",
        "created_at": "2020-08-24T22:30:55.000000Z",
        "updated_at": "2020-08-24T22:30:55.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 5,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    },
    {
        "id": 6,
        "name": "test 209",
        "size": 8,
        "completed_at": "2020-08-25 12:25:28",
        "created_at": "2020-08-25T15:25:28.000000Z",
        "updated_at": "2020-08-25T15:25:28.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 7,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    },
    {
        "id": 7,
        "name": "afsdf",
        "size": 4,
        "completed_at": "2020-08-25 12:49:47",
        "created_at": "2020-08-25T15:49:47.000000Z",
        "updated_at": "2020-08-25T15:49:47.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 8,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    },
    {
        "id": 8,
        "name": "testing 10",
        "size": 3,
        "completed_at": "2020-08-25 19:10:40",
        "created_at": "2020-08-25T22:10:40.000000Z",
        "updated_at": "2020-08-25T22:10:40.000000Z",
        "user_id": 1,
        "status": 0,
        "grid_id": 9,
        "users": {
            "id": 1,
            "name": "Mario Andrés Gonzalez Oviedo",
            "email": "test01@test.com",
            "email_verified_at": null,
            "api_token": "oMjKSKzuYVVT1h9LuVfNz6Ocjf4ZwYeZEPBK4MgE4TEecsgSenwRjdaiBXaJU2nmOdifpTamzj5NtyX0",
            "created_at": "2020-08-14T01:17:16.000000Z",
            "updated_at": "2020-08-14T01:17:16.000000Z"
        }
    }
]
</pre>

<h2>Get Game by ID</h2>
<h3>GET /api/games/{gameId}</h3>
<h4>Example<h4>
<p>Request</p>
<pre>
GET /api/games/1
</pre>
<p>Response</p>
<pre>
{
    "game": [
        {
            "id": 1,
            "name": "testing 10",
            "size": 3,
            "completed_at": "2020-08-13 22:17:41",
            "created_at": "2020-08-14T01:17:41.000000Z",
            "updated_at": "2020-08-14T01:17:41.000000Z",
            "user_id": 1,
            "status": 0,
            "grid_id": 1,
            "grid": {
                "id": 1,
                "width": 3,
                "height": 3,
                "bombs": 4,
                "created_at": "2020-08-14T01:17:40.000000Z",
                "updated_at": "2020-08-14T01:17:40.000000Z",
                "squares": [
                    {
                        "id": 1,
                        "grids_id": 1,
                        "x": 1,
                        "y": 1,
                        "content": 0,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:40.000000Z",
                        "updated_at": "2020-08-14T18:42:29.000000Z"
                    },
                    {
                        "id": 2,
                        "grids_id": 1,
                        "x": 2,
                        "y": 1,
                        "content": 10,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:40.000000Z",
                        "updated_at": "2020-08-14T18:42:29.000000Z"
                    },
                    {
                        "id": 3,
                        "grids_id": 1,
                        "x": 3,
                        "y": 1,
                        "content": 10,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:40.000000Z",
                        "updated_at": "2020-08-14T18:42:29.000000Z"
                    },
                    {
                        "id": 4,
                        "grids_id": 1,
                        "x": 1,
                        "y": 2,
                        "content": 0,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:40.000000Z",
                        "updated_at": "2020-08-14T18:42:27.000000Z"
                    },
                    {
                        "id": 5,
                        "grids_id": 1,
                        "x": 2,
                        "y": 2,
                        "content": 10,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:40.000000Z",
                        "updated_at": "2020-08-14T18:42:27.000000Z"
                    },
                    {
                        "id": 6,
                        "grids_id": 1,
                        "x": 3,
                        "y": 2,
                        "content": 10,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:41.000000Z",
                        "updated_at": "2020-08-14T18:42:27.000000Z"
                    },
                    {
                        "id": 7,
                        "grids_id": 1,
                        "x": 1,
                        "y": 3,
                        "content": 0,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:41.000000Z",
                        "updated_at": "2020-08-14T18:42:27.000000Z"
                    },
                    {
                        "id": 8,
                        "grids_id": 1,
                        "x": 2,
                        "y": 3,
                        "content": 0,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:41.000000Z",
                        "updated_at": "2020-08-14T18:42:27.000000Z"
                    },
                    {
                        "id": 9,
                        "grids_id": 1,
                        "x": 3,
                        "y": 3,
                        "content": 0,
                        "discover": 1,
                        "created_at": "2020-08-14T01:17:41.000000Z",
                        "updated_at": "2020-08-14T18:42:27.000000Z"
                    }
                ]
            }
        }
    ]
}

</pre>
<h2>Update a square</h2>
<p>To update a square from a certain game you need to send a PUT request to the resource: <code>/api/games/{gameId}</code></p>
<p>
The event object consists of the following properties:
</p>
<pre>
{
  "squareId": {squareId},
  "event": {event}
  "staus" : {status}(optional, no all the events use this)
}
</pre>
<p>The available event types are:</p>
<ul>
<li>Reveal square (reveal)</li>
<li>Add a flag to square (flag)</li>
<li>Add a question mark to square (question)</li>
<p>For example, to reveal a square of id <b>25</b> you need to send this object in the request body:</p>
<pre>
{
    'sqareId': 25,
    'event': 'reveal'    
}
</pre>
<p>The response will contain the whole Board with its current status.</p>
<h3>
PUT /api/games/{squareId}
</h3>
<h4>Example</h4>
<p>Request</p>
<pre>
PUT /api/games/3
{
  "squareId": "25",
  "event": "reveal"
}
</pre>
<p>Response</p>
<pre>
[{
        content: 10
        created_at: "2020-08-25T22:31:51.000000Z"
        discover: 0
        grids_id: 17
        id: 412
        updated_at: "2020-08-25T22:31:51.000000Z"
        x: 2
        y: 3
    },
    {
        "BOMB"
    },
    {
        "BOMB"
    },
    {
        content: 0
        created_at: "2020-08-25T22:31:51.000000Z"
        discover: 1
        grids_id: 17
        id: 409
        updated_at: "2020-08-26T00:28:27.000000Z"
        x: 2
        y: 2
    },
    {
        "BOMB"
    },
    {
        content: 0
        created_at: "2020-08-25T22:31:51.000000Z"
        discover: 1
        grids_id: 17
        id: 408
        updated_at: "2020-08-26T00:28:27.000000Z"
        x: 1
        y: 2
    },
    {
        content: 0
        created_at: "2020-08-25T22:31:51.000000Z"
        discover: 1
        grids_id: 17
        id: 410
        updated_at: "2020-08-26T00:28:27.000000Z"
        x: 3
        y: 2
    },
    {
        "BOMB"
    },
    {
        "BOMB"
    }
]
</pre>
<h4>Other Example</h4>
<p>Request</p>
<pre>
PUT /api/games/3
{
  "squareId": "25",
  "event": "updateStatus",
  "status": "flag"
}
</pre>
<p>Response</p>
<pre>
[
    {
        content: 0
        created_at: "2020-08-25T22:24:03.000000Z"
        discover: 2 || this value means flag, 3 , means Question mark
        grids_id: 10
        id: 342
        updated_at: "2020-08-26T00:54:40.000000Z"
        x: 2
        y: 3
    }
]
</pre>
