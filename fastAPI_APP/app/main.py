from fastapi import FastAPI
from app.routers import validacion, fondo

app = FastAPI(title="Servicio de Validación Facial")

app.include_router(
    validacion.router,
    prefix="/validacion",
    tags=["Validación Facial"]
)
app.include_router(fondo.router)