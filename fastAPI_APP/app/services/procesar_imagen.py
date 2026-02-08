import cv2
import mediapipe as mp
import numpy as np


class ProcesadorImagen:
    def __init__(self):
        self.mp_face = mp.solutions.face_detection
        self.detector = self.mp_face.FaceDetection(
            model_selection=1,      # 0 = cerca / 1 = rango medio
            min_detection_confidence=0.6
        )

    def procesar(self, path: str) -> dict:
        img = cv2.imread(path)

        if img is None:
            return {
                "ok": False,
                "mensaje": "No se pudo leer la imagen"
            }

        h, w, _ = img.shape
        rgb = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

        result = self.detector.process(rgb)

        if not result.detections:
            return {
                "ok": False,
                "mensaje": "No se detectó ningún rostro"
            }

        detection = result.detections[0]
        box = detection.location_data.relative_bounding_box

        x = int(box.xmin * w)
        y = int(box.ymin * h)
        bw = int(box.width * w)
        bh = int(box.height * h)

        # Métricas clave
        area_rostro = bw * bh
        area_imagen = w * h
        ratio = area_rostro / area_imagen

        centrado_x = abs((x + bw / 2) - (w / 2)) / w
        centrado_y = abs((y + bh / 2) - (h / 2)) / h

        rostro_centrado = centrado_x < 0.12 and centrado_y < 0.12
        tamano_correcto = 0.18 <= ratio <= 0.45

        ok = rostro_centrado and tamano_correcto

        return {
            "key": "rostro",
            "label": "Rostro visible y correctamente posicionado",
            "ok": ok,
            "detalle": {
                "rostro_detectado": True,
                "confianza": round(detection.score[0], 2),
                "centrado": rostro_centrado,
                "tamano_correcto": tamano_correcto,
                "ratio": round(ratio, 3),
            },
            "mensaje": None if ok else self._mensaje_error(
                rostro_centrado, tamano_correcto
            )
        }

    def _mensaje_error(self, centrado: bool, tamano: bool) -> str:
        if not centrado:
            return "El rostro no está centrado correctamente"
        if not tamano:
            return "El rostro no tiene el tamaño adecuado"
        return "El rostro no cumple los requisitos"
