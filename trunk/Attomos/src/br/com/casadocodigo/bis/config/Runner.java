package br.com.casadocodigo.bis.config;

public class Runner {
	private static boolean isGamePlaying;
	private static boolean isGamePaused;
	private static int actualVelocity = 1;
	private static int nexButton = 0;
	private static int nexButtonFinal = 0;
	private static int  MAXIMO_LEVEL  = 5;
	//Limite Score para NexLevel
	private static int LIMIT_NEXT_LEVEL = 5;
	
	static Runner runner = null;
	
	private Runner(){
		
	}
	
	public  static Runner check(){
		if (runner!=null){
			runner = new Runner();
		}
		return runner;
	}
	
	public static boolean isGamePlaying() {
		return isGamePlaying;
	}

	public static boolean isGamePaused() {
		return isGamePaused;
	}

	public static void setGamePlaying(boolean isGamePlaying) {
		Runner.isGamePlaying = isGamePlaying;
	}

	public static void setGamePaused(boolean isGamePaused) {
		Runner.isGamePaused = isGamePaused;
	}
	
	public static int getActualVelocity()
	{
		return actualVelocity;
	}
	
	public static void ActualVelocityIncrease()
	{
		actualVelocity++;
	}
	
	public static int getNextButton()
	{
		return nexButton;
	}
	
	public static void nextButtonIncrease()
	{
		nexButton++;
	}
	
	public static void resetNexButton()
	{
		nexButton = 0;
	}
	
	public static int getMaximoLevel()
	{
		return MAXIMO_LEVEL;
	}
	
	public static int getLimitScoreLevel()
	{
		return LIMIT_NEXT_LEVEL;
	}
	
	public static void resetFinalButton()
	{
		nexButtonFinal = 0;
	}
	
	public static int getFinalButton(){
		return nexButtonFinal;
	}
	
	public static void finalButtonIncrease(){
		nexButtonFinal++;
	}
}
