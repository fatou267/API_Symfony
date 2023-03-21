import React from 'react';
import BuildingPresence from './BuildingPresence';

function OrganisationPresence({ name, buildings }) {
  const totalPresence = buildings.reduce(
    (total, building) => total + building.totalPresence,
    0
  );

  return (
    <div>
      <h1>{name}</h1>
      {buildings.map((building) => (
        <BuildingPresence
          key={building.id}
          name={building.nom}
          pieces={building.pieces}
        />
      ))}
      <p>Nombre de personnes présentes dans l'organisation: {totalPresence}</p>
    </div>
  );
}

export default OrganisationPresence