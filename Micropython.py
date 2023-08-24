import network
import urequests
import time

# WiFi credentials
ssid = "your_wifi_ssid"
password = "your_wifi_password"

# Server details
server_host = "your_server_ip_or_domain"
server_port = 80  # Adjust if needed

def connect_to_wifi():
    wifi = network.WLAN(network.STA_IF)
    wifi.active(True)
    if not wifi.isconnected():
        print("Connecting to WiFi...")
        wifi.connect(ssid, password)
        while not wifi.isconnected():
            pass
    print("Connected to WiFi")

def main():
    connect_to_wifi()
    
    while True:
        # Simulated values, replace with your actual data
        id = "your_device_id"
        pressure = 0.8
        active = True
        
        # Create the HTTP request
        http_request = (
            f"GET /update.php"
            f"?ID={id}"
            f"&Pressure={pressure}"
            f"&Active={active}"
            " HTTP/1.1\r\n"
            f"Host: {server_host}\r\n"
            "Connection: close\r\n\r\n"
        )
        
        try:
            # Make the request
            client = urequests.request("GET", f"http://{server_host}:{server_port}/update.php")
            print("Sending HTTP request...")
            
            for line in client.iter_lines():
                print(line.decode("utf-8"))
            
            client.close()
            print("Request complete")
            
        except Exception as e:
            print("Connection failed:", e)
        
        # Wait for a while before sending the next update
        time.sleep(5)

if __name__ == "__main__":
    main()
