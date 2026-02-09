import cv2
import numpy as np
import mediapipe as mp

class FondoValidator:
    def __init__(self):
        self.segmentador = mp.solutions.selfie_segmentation.SelfieSegmentation(
            model_selection=1
        )

    def validar(self, path: str) -> dict:
        img = cv2.imread(path)
        if img is None:
            return {"ok": False, "mensaje": "No se pudo leer la imagen"}

        rgb = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        seg = self.segmentador.process(rgb)

        if seg.segmentation_mask is None:
            return {"ok": False, "mensaje": "No se pudo segmentar el fondo"}

        bg = (seg.segmentation_mask < 0.15).astype(np.uint8)

        lab = cv2.cvtColor(img, cv2.COLOR_BGR2LAB)
        L, A, B = cv2.split(lab)

        Lb = L[bg == 1]
        Ab = A[bg == 1]
        Bb = B[bg == 1]

        claridad = np.mean(Lb)
        neutralidad = np.std(Ab) + np.std(Bb)
        uniformidad = np.std(Lb)

        edges = cv2.Canny(L, 80, 160)
        edge_ratio = np.sum(edges[bg == 1] > 0) / np.sum(bg)

        reglas = {
            "claro": bool(claridad > 200),
            "neutro": bool(neutralidad < 16),
            "uniforme": bool(uniformidad < 18),
            "sin_estructuras": bool(edge_ratio < 0.06)
        }

        ok = sum(reglas.values()) >= 3

        return {
            "key": "fondo",
            "ok": ok,
            "detalle": {
                "claridad": round(float(claridad), 1),
                "neutralidad": round(float(neutralidad), 1),
                "uniformidad": round(float(uniformidad), 1),
                "edge_ratio": round(float(edge_ratio), 3),
                "reglas": reglas
            },
            "mensaje": None if ok else "Fondo inválido"
        }