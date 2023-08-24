#include <ESP8266WiFi.h> // For ESP8266
// #include <WiFi.h>      // For ESP32

const char* ssid = "your_wifi_ssid";
const char* password = "your_wifi_password";
const char* serverHost = "your_server_ip_or_domain";
const int serverPort = 80; // Adjust if needed

void setup() {
  Serial.begin(115200);
  
  // Connect to Wi-Fi
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }

  Serial.println("Connected to WiFi");
}

void loop() {
  // Simulated values, replace with your actual data
  String id = "your_device_id";
  float pressure = 0.8;
  bool active = true;

  // Create the HTTP request
  String httpRequest = "GET /update.php";
  httpRequest += "?ID=" + id;
  httpRequest += "&Pressure=" + String(pressure);
  httpRequest += "&Active=" + String(active);
  httpRequest += " HTTP/1.1\r\n";
  httpRequest += "Host: " + String(serverHost) + "\r\n";
  httpRequest += "Connection: close\r\n\r\n";

  // Make the request
  WiFiClient client;
  if (client.connect(serverHost, serverPort)) {
    client.print(httpRequest);
    Serial.println("Sending HTTP request...");
    
    while (client.connected()) {
      String line = client.readStringUntil('\n');
      Serial.println(line);
    }
    
    Serial.println("Request complete");
  } else {
    Serial.println("Connection failed");
  }

  client.stop();
  
  // Wait for a while before sending the next update
  delay(5000);
}
