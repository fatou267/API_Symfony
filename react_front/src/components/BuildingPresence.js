import React from 'react';
import PresenceData from './PresenceData';

function BuildingPresence({ name, pieces }) {
  const totalPresence = pieces.reduce((total, piece) => total + piece.presence, 0);

  return (
    <div>
      <h2>{name}</h2>
      {pieces.map((piece) => (
        <PresenceData key={piece.id} name={piece.nom} presence={piece.presence} />
      ))}
      <p>Nombre de personnes présentes dans le bâtiment: {totalPresence}</p>
    </div>
  );
}

export default BuildingPresence