from pydantic import BaseModel

class ResultadoFacial(BaseModel):
    ok: bool
    ojos: bool
    boca: bool
    inclinacion: float
    confianza: float
    mensaje: str | None = None
