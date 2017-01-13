# CLI Commands

## hello
Displays basic server and game world information

## i_know_i_am_about_to_truncate_my_world
Destroys all locations in the game world permanently

## generate_world
Checks each location on the world grid and creates the location
if it does not exist.

The size of the world depends on the server world configuration where
the size of the map is always square and equals `size * size`. The
default size is `256` which equates to `256 x 256` or `65536` locations total.

This takes a long time, generally. This executes as a server event
and there for only creates one location per tick. Before you start 
running your server, during this generation phase, you can safely 
set your config server rate to `10`.

```json
{
    "server": {
        "rate":     10
    },
    "world": {
        "size":     256
    }
}
```

Remember to change it back to `1000000` when you're done;