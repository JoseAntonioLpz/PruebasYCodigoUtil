package main;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Base64;
import java.util.Scanner;
import java.util.StringTokenizer;

public class Comprobator {
	
	private String lastFile, lastFileContent, newFile, newFileContent, fusionFile;
	
	public Comprobator(String lastFile, String newFile) {
		this.lastFileContent = getContentFile(lastFile);
		this.newFileContent = getContentFile(newFile);
	}
	
	public static String getContentFile(String file) { // Obtener contenido de un fichero
		String content = "";
		
		try {
			Scanner sc = new Scanner(new File(file));
			
			while(sc.hasNextLine()) {
				content += sc.nextLine().trim() + "\n";
			}
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		}
		
		return content;
	}
	
	public String getFusionFileContent() { // Obtencion del contenido del fichero resultante de la fusion
		String fusionFileContent = "<html><head><title>Documento fusionado</title><style>.original xmp{background-color: red;text-decoration: line-through;}.cambio xmp{background-color: green;width: auto;}.content{display: flex;align-items: center;}</style></head><body>";
		
		StringTokenizer lastFileContentLines = new StringTokenizer(this.lastFileContent, "\n");
		StringTokenizer newFileContentLines = new StringTokenizer(this.newFileContent, "\n");
		
		int contLine = 1;
		
		while(lastFileContentLines.hasMoreTokens() || newFileContentLines.hasMoreTokens()) {
			String lineFusion = "";
			String linelastFile = "";
			String linenewFile = "";
			
			if(lastFileContentLines.hasMoreTokens()) {
				linelastFile = lastFileContentLines.nextToken();
			}
			
			if(newFileContentLines.hasMoreTokens()) {
				linenewFile = newFileContentLines.nextToken();
			}
			
			if(!linelastFile.equals(linenewFile)) {
				lineFusion = "<div class='content'>Line:" + contLine + "&nbsp;<span class='original'><xmp>" + linelastFile + "</xmp></span></div><div class='content'>Line:" + contLine + "&nbsp;<span class='cambio'><xmp>" + linenewFile + "</xmp></span></div>"; 
			}else {
				lineFusion = "<div class='content'>Line:" + contLine + "&nbsp;<xmp>" + linelastFile + "</xmp></div>";
			}
			
			fusionFileContent += lineFusion;
			contLine++;
		}
		
		fusionFileContent += "</body></html>";
		
		return fusionFileContent;
	}
	
	public Boolean generateFusionFile(String uri) { // Guardar fichero fusionado
		FileWriter f = null;
        PrintWriter pw = null;
        Boolean res = false;
		try {
			f =  new FileWriter(uri);
			pw = new PrintWriter(f);
			StringTokenizer content = new StringTokenizer(this.getFusionFileContent(), "\n");
			
			while(content.hasMoreTokens()) {
				pw.println(content.nextToken());
			}
		}catch(IOException e) {
			e.printStackTrace();
		}finally {
			try {
				if (null != f) f.close();
				res = true;
			} catch (IOException e) {
				e.printStackTrace();
			}
		}
		return res;
	}
	
	public String getBase64FusionFileContent() { // Obtencion del contenido del fichero en base64
		return Base64.getEncoder().encodeToString(this.getFusionFileContent().getBytes());
	}
	
	//DEBUG
	public void get() { // Comprobar el estado de las variables
		System.out.println(this.lastFileContent);
		System.out.println(this.newFileContent);
	}
}
