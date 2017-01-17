# System Events

| Event Name            | Applies to            | Description |
| ----------            | ----------            | ----------- |
*bootstrap_loaded*      | All                   | Raised once bootstrap is loaded successfully
*shell_loaded*          | Shell All             | Raised when shell has started with valid extension
*server_started*        | Shell Server          | Raised before first tick of running server
*server_tick*           | Shell Server          | Raised on tick of running server
*server_stopped*        | Shell Server          | Raised after last tick or running server
*game_server_started*   | Shell Server          | Raised once the server control has been passed over to the game engine