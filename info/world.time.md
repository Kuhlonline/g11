# World Time

The tick rate govern the world time speed. It can be found in the ./server/x.json file. Where (x) is the name of the release

e.g.
`./system/argon.json`

Contains:
```json
    {
        "world": {
            "tick": 6
        }
    }
```

Which sets time to move at x6 Normal time passage in real life. There are
only a few valid values

| Setting | Minutes | Hours |
| ------- | -------------- | --- |
| 1 | 1440 Minutes | 24 Hours
| 2 | 570 Minutes |
| 3 | 480 Minutes |
| 6 | 240 Minutes | 4 Hours
| 10| 144 Minutes |
| 15| 96 Minutes | 1.5 Hours
| 20| 57 Minutes | 1 Hour
| 30| 48 Minutes |
| 60| 24 Minutes | 

* All Times are approximat