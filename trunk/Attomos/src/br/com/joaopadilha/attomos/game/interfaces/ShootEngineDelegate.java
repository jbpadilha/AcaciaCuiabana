package br.com.joaopadilha.attomos.game.interfaces;

import br.com.joaopadilha.attomos.game.objects.Shoot;

public interface ShootEngineDelegate {
	public void createShoot(
			Shoot shoot);

	public void removeShoot(Shoot shoot);
}
