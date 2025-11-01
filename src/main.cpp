#include <Arduino.h>
#include <WiFi.h>
#include <HTTPClient.h>
#include <TinyGPSPlus.h>

// ---- CONFIGURACIÓN WiFi ----
const char* ssid = "TU_WIFI";
const char* password = "TU_CONTRASEÑA";

// ---- CONFIGURACIÓN SERVIDOR PHP ----
const char* serverName = "http://TU_IP_LOCAL/tu_carpeta/insertar_localizacion.php"; 

// ---- GPS ----
TinyGPSPlus gps;
HardwareSerial SerialGPS(2); // Usaremos el puerto 2 (GPIO16=RX2, GPIO17=TX2)

void setup() {
  Serial.begin(115200);
  SerialGPS.begin(9600, SERIAL_8N1, 16, 17);

  WiFi.begin(ssid, password);
  Serial.print("Conectando a WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\n✅ Conectado a WiFi");
}

void loop() {
  while (SerialGPS.available() > 0) {
    gps.encode(SerialGPS.read());
  }

  if (gps.location.isUpdated()) {
    float latitud = gps.location.lat();
    float longitud = gps.location.lng();
    int id_animal = 1; // Cambiar según el animal registrado

    Serial.printf("📍 Latitud: %.6f, Longitud: %.6f\n", latitud, longitud);

    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;
      http.begin(serverName);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");

      String httpRequestData = "id_animal=" + String(id_animal) +
                               "&latitud=" + String(latitud, 6) +
                               "&longitud=" + String(longitud, 6);

      int httpResponseCode = http.POST(httpRequestData);

      if (httpResponseCode > 0) {
        Serial.printf("✅ Datos enviados correctamente. Respuesta: %s\n", http.getString().c_str());
      } else {
        Serial.printf("❌ Error enviando: %d\n", httpResponseCode);
      }

      http.end();
    } else {
      Serial.println("⚠️ WiFi no conectado");
    }

    delay(10000);
  }
}
