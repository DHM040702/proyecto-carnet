from fastapi import APIRouter, UploadFile, File
from app.services.fondo_validator import FondoValidator
import uuid, os, shutil

router = APIRouter(prefix="/fondo", tags=["Fondo"])
validator = FondoValidator()

@router.post("/validar")
async def validar_fondo(file: UploadFile = File(...)):
    path = f"tmp/{uuid.uuid4()}.jpg"
    with open(path, "wb") as f:
        shutil.copyfileobj(file.file, f)

    res = validator.validar(path)
    os.remove(path)
    return res