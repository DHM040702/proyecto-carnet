# app/routers/validacion.py
from fastapi import APIRouter, UploadFile, File
from app.services.procesar_imagen import ProcesadorImagen
import uuid
import os
import shutil

router = APIRouter()

TEMP_DIR = "tmp"
os.makedirs(TEMP_DIR, exist_ok=True)

@router.post("/foto")
async def validar_foto(file: UploadFile = File(...)):
    # 1. Guardar archivo temporal
    ext = file.filename.split(".")[-1]
    filename = f"{uuid.uuid4()}.{ext}"
    temp_path = os.path.join(TEMP_DIR, filename)

    with open(temp_path, "wb") as buffer:
        shutil.copyfileobj(file.file, buffer)

    # 2. Procesar imagen
    procesador = ProcesadorImagen()
    resultado = procesador.procesar(temp_path)

    # 3. Limpiar archivo temporal
    os.remove(temp_path)

    return resultado
