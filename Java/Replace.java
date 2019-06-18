package prueba;

public class Replace {
	
	private String[] rep;
	private String org;
	private String by;
	
	public Replace(String[] rep, String org, String by) {
		this.rep = rep;
		this.org = org;
		this.by = by;
	}
	
	public String replaceAll() {
		for(String r : this.getRep()) {
			this.setOrg(this.getOrg().replaceAll(r, this.getBy()));
		}
		return this.getOrg();
	}
	
	public static String replaceAll(String[] rep, String org, String by) {
		return new Replace(rep, org, by).replaceAll();
	}
	
	private String getOrg() {
		return this.org;
	}
	
	private void setOrg(String org) {
		this.org = org;
	}
	
	private String[] getRep() {
		return this.rep;
	}
	
	private String getBy() {
		return this.by;
	}
}
