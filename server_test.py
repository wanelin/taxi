import asyncio
import websockets
import json
connected = set()
async def echo(websocket, path):
    global connected
    # Register.
    connected.add(websocket)
    try:
        # Implement logic here.
        async for message in websocket:
            for ws in connected:
                print(ws)
                await ws.send(message)
        await asyncio.wait([ws.send("Hello!") for ws in connected])
        await asyncio.sleep(10)
    finally:
        # Unregister.
        connected.remove(websocket)
    
async def get(websocket, path):
    print("ok")
asyncio.get_event_loop().run_until_complete(
    websockets.serve(echo, 'localhost', 1234))
asyncio.get_event_loop().run_forever()
