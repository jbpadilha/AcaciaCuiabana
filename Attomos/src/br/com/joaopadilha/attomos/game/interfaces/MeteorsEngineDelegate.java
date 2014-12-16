package br.com.joaopadilha.attomos.game.interfaces;

import br.com.joaopadilha.attomos.game.objects.Level;
import br.com.joaopadilha.attomos.game.objects.Meteor;

public interface MeteorsEngineDelegate {
	public void createMeteor(Meteor meteor);
	public void removeMeteor(Meteor meteor);
}
