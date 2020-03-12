package main;

public class Main {

	public static void main(String[] args) {
		// TODO Auto-generated method stub

		String file1 = "src/resources/1.html";
		String file2 = "src/resources/2.html";
		
		Comprobator c = new Comprobator(file1, file2);
		
		//c.get();
		
		//String ff = c.getFusionFile();
		String ff = c.getBase64FusionFileContent();
		Boolean b = c.generateFusionFile("src/resources/fusion.html");
				
		System.out.println(ff);
		System.out.println(b);
	}

}
